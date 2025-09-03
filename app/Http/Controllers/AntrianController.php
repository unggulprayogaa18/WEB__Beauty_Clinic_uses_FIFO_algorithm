<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\DaftarAntrian;
use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon; // Pastikan Anda mengimpor Carbon di atas controller Anda
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AntrianController extends Controller
{
    //
    public function index()
    {
        $tanggalHariIni = Carbon::today()->toDateString();

        // 1. Ambil data antrian utama dengan relasi produk
        $antrians = DaftarAntrian::with('produk')
            ->whereIn('status', ['pending', 'selesai'])
            ->whereDate('tanggal_permintaan', $tanggalHariIni)
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        // 2. Loop setiap antrian untuk mencari dan melampirkan tanggal kedaluwarsa FIFO
        foreach ($antrians as $antrian) {
            // Pastikan produk ada untuk menghindari error
            if ($antrian->produk) {
                // Cari batch barang masuk terlama (FIFO) yang stoknya masih ada (> 0)
                $batchFifo = BarangMasuk::where('id_produk', $antrian->produk->id_produk)
                    ->where('jumlah', '>', 0) // Hanya batch yang masih punya stok
                    ->orderBy('tanggal_masuk', 'asc') // Urutkan dari yang paling lama masuk
                    ->first(); // Ambil yang pertama (paling lama)

                // 3. Lampirkan tanggal kedaluwarsa ke objek antrian
                // Ini membuat data mudah diakses di view
                if ($batchFifo) {
                    $antrian->tanggal_kedaluwarsa_fifo = $batchFifo->tanggal_kedaluwarsa;
                } else {
                    // Jika tidak ada stok sama sekali
                    $antrian->tanggal_kedaluwarsa_fifo = null;
                }
            }
        }

        return view('admin.daftar_antrian.daftarantrian', compact('antrians'));
    }

    public function process(Request $request, $id)
    {
        // Validasi input dasar (ID Produk dan Jumlah Diminta dari form)
        // Nama field 'jumlah_diminta' sesuai dengan yang kita set di form sebelumnya
        $validatedData = $request->validate([
            'id_produk' => 'required|string|exists:produk,id_produk', // Pastikan id_produk ada di tabel produk
            'jumlah_diminta' => 'required|integer|min:1',
            // 'tanggal_permintaan' => 'required|date_format:Y-m-d', // Validasi jika Anda memerlukannya di sini
        ]);

        $idAntrian = $id;
        $idProduk = $validatedData['id_produk'];
        $jumlahDimintaDariAntrian = $validatedData['jumlah_diminta'];

        // 1. Ambil data antrian dan produk
        $antrian = DaftarAntrian::find($idAntrian);
        if (!$antrian) {
            return redirect()->back()->with('error', 'Antrian tidak ditemukan.');
        }

        $produk = Produk::find($idProduk);
        if (!$produk) {
            // Sebenarnya validasi 'exists:produk,id_produk' di atas sudah menangani ini,
            // tapi sebagai lapisan tambahan jika validasi dilewati/diubah.
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // 2. Hanya proses jika status antrian sesuai (misalnya 'pending' atau 'gagal' jika bisa diproses ulang)
        if (!in_array($antrian->status, ['pending', 'gagal'])) {
            return redirect()->back()->with('warning', 'Antrian ini tidak dapat diproses karena statusnya saat ini adalah ' . $antrian->status . '.');
        }

        // 3. Pengecekan Stok Awal (sebelum transaksi)
        $totalStokProdukTersedia = $produk->barangMasuks()->where('jumlah', '>', 0)->sum('jumlah');

        if ($totalStokProdukTersedia < $jumlahDimintaDariAntrian) {
            // Jika stok tidak cukup, ubah status antrian menjadi 'gagal' dan beri catatan
            $antrian->status = 'gagal';
            $antrian->catatan_gagal = 'Stok produk tidak mencukupi. Stok tersedia: ' . $totalStokProdukTersedia . ', diminta: ' . $jumlahDimintaDariAntrian . '.';
            $antrian->save();
            return redirect()->back()->with('error', $antrian->catatan_gagal);
        }

        // 4. Mulai Transaksi Database
        DB::beginTransaction();

        try {
            // 4a. Logika untuk mengurangi jumlah dari tabel barang_masuk (FIFO)
            $sisaJumlahDiminta = $jumlahDimintaDariAntrian;

            $barangMasukTersedia = $produk->barangMasuks()
                ->where('jumlah', '>', 0)       // Hanya batch yang masih ada stoknya
                ->orderBy('tanggal_masuk', 'asc') // Urutkan berdasarkan tanggal masuk (FIFO)
                // Pertimbangkan ->orderBy('tanggal_kedaluwarsa', 'asc') juga jika FEFO (First-Expired, First-Out) lebih sesuai
                ->get();

            foreach ($barangMasukTersedia as $batchMasuk) {
                if ($sisaJumlahDiminta <= 0) {
                    break; // Semua jumlah yang diminta sudah terpenuhi
                }

                $jumlahBisaDiambilDariBatchIni = min($batchMasuk->jumlah, $sisaJumlahDiminta);

                $batchMasuk->jumlah -= $jumlahBisaDiambilDariBatchIni; // Kurangi jumlah di record barang_masuk
                $batchMasuk->save(); // Simpan perubahan pada record barang_masuk

                $sisaJumlahDiminta -= $jumlahBisaDiambilDariBatchIni;
            }

            // 4b. Safeguard: Jika setelah loop masih ada sisa jumlah yang diminta (seharusnya tidak terjadi jika pengecekan stok awal benar)
            if ($sisaJumlahDiminta > 0) {
                DB::rollBack(); // Batalkan semua perubahan database
                $antrian->status = 'gagal';
                $antrian->catatan_gagal = 'Gagal memenuhi permintaan stok sepenuhnya meskipun pengecekan awal berhasil. Harap periksa konsistensi data.';
                // Penting: Simpan $antrian di luar transaksi setelah rollback jika ingin status 'gagal' tercatat
                // Namun, karena ini anomali, mungkin lebih baik log error dan investigasi.
                // Untuk saat ini, kita langsung log dan redirect.
                Log::critical('Stok anomaly pada Antrian ID: ' . $idAntrian . ' untuk Produk ID: ' . $idProduk . '. Sisa diminta: ' . $sisaJumlahDiminta);
                return redirect()->back()->with('error', 'Terjadi masalah tak terduga dalam pemenuhan stok. Silakan hubungi administrator.');
            }

            // 4c. Update status antrian menjadi 'selesai'
            $antrian->status = 'selesai';
            $antrian->diproses_pada = now(); // Mengisi waktu saat ini
            $antrian->catatan_gagal = null;  // Bersihkan catatan gagal jika sebelumnya ada
            $antrian->save();

            // 4d. Jika semua berhasil, commit transaksi
            DB::commit();

            return redirect()->route('admin.daftarAntrian.index') // Ganti dengan nama route daftar antrian Anda
                ->with('success', 'Antrian (' . $antrian->nomer_antrian . ') berhasil diselesaikan dan stok telah dikurangi.');

        } catch (\Exception $e) {
            // 5. Jika terjadi error, rollback transaksi
            DB::rollBack();
            Log::error('Gagal memproses antrian (ID: ' . $idAntrian . ') karena: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());

            // Opsional: Update status antrian menjadi 'gagal' dengan catatan error sistem
            // Perlu hati-hati jika $antrian sudah di-save di dalam try block sebelum error
            // $antrianSetelahError = DaftarAntrian::find($idAntrian); // Ambil ulang instance bersih
            // if ($antrianSetelahError) {
            //     $antrianSetelahError->status = 'gagal';
            //     $antrianSetelahError->catatan_gagal = 'Terjadi kesalahan sistem saat pemrosesan.';
            //     $antrianSetelahError->save();
            // }

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses antrian. Silakan coba lagi atau hubungi administrator.');
        }
    }

}
