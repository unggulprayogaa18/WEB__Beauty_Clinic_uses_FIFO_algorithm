<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DaftarAntrian;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function barangMasuk()
    {
        // Use paginate() to enable pagination.
        // For example, display 10 items per page.
        $barangMasuks = BarangMasuk::with('produk')->paginate(10);

        // Pass the paginated data to the view
        return view('admin.laporan.LaporanBarangMasuk', compact('barangMasuks'));
    }

    public function barangKeluar()
    {
        // Mengambil data Barang Keluar dengan relasi Produk, dan paginasi
        $barangKeluars = BarangKeluar::with('produk')->paginate(10, ['*'], 'barang_keluar_page');
        // Catatan: 'barang_keluar_page' adalah nama parameter query string untuk paginasi Barang Keluar.
        // Ini penting agar paginasi kedua tabel tidak saling tumpang tindih.

        // Mengambil data Daftar Antrian dengan relasi Produk, dan paginasi
        $daftarAntrians = DaftarAntrian::with('produk')->paginate(10, ['*'], 'daftar_antrian_page');
        // Catatan: 'daftar_antrian_page' adalah nama parameter query string untuk paginasi Daftar Antrian.

        // Mengirimkan kedua set data ke view
        return view('admin.laporan.LaporanBarangKeluar', compact('barangKeluars', 'daftarAntrians'));
    }


    public function Antrian(Request $request)
    {
        $filterStatus = $request->query('status');
        $laporanAntrianData = collect();

        // Jika filterStatus kosong atau 'selesai', ambil data BarangKeluar
        if (is_null($filterStatus) || $filterStatus === 'selesai') {
            $barangKeluars = BarangKeluar::with('produk')->get()->map(function ($item) {
                return [
                    'id' => $item->id_keluar, // Use the actual ID for BarangKeluar
                    'id_antrian' => $item->id_keluar,
                    'tipe' => 'Selesai', // Keep this to differentiate
                    'tanggal' => $item->tanggal_keluar,
                    'nama_produk' => $item->produk->nama_produk,
                    'jumlah' => $item->jumlah,
                ];
            });
            $laporanAntrianData = $laporanAntrianData->merge($barangKeluars);
        }

        // Jika filterStatus kosong atau 'pending', ambil data DaftarAntrian
        if (is_null($filterStatus) || $filterStatus === 'pending') {
            $daftarAntrians = DaftarAntrian::with('produk')->get()->map(function ($item) {
                return [
                    'id' => $item->id, // Use the actual ID for DaftarAntrian
                    'id_antrian' => $item->nomer_antrian,
                    'tipe' => 'Dalam Antrian', // Keep this to differentiate
                    'tanggal' => $item->tanggal_antrian,
                    'nama_produk' => $item->produk->nama_produk,
                    'jumlah' => $item->jumlah_diminta,
                ];
            });
            $laporanAntrianData = $laporanAntrianData->merge($daftarAntrians);
        }

        $laporanAntrianData = $laporanAntrianData->sortByDesc('tanggal');

        return view('admin.laporan.LaporanAntrian', compact('laporanAntrianData', 'filterStatus'));
    }


    public function destroyAntrian($tipe, $id)
    {
        try {
            if ($tipe === 'Dalam Antrian') {
                $itemToDelete = DaftarAntrian::findOrFail($id);

                // Optional: Only allow deletion if status is 'pending' or 'gagal' for DaftarAntrian
                if ($itemToDelete->status !== 'pending' && $itemToDelete->status !== 'gagal') {
                    return redirect()->route('laporan.antrian')->with('error', 'Hanya antrian dengan status "pending" atau "gagal" yang dapat dihapus.');
                }
                $itemToDelete->delete();
                $message = 'Data antrian berhasil dihapus.';

            } elseif ($tipe === 'Selesai') {
                $itemToDelete = BarangKeluar::findOrFail($id);
                // No specific status check needed for BarangKeluar if all can be deleted
                $itemToDelete->delete();
                $message = 'Data barang keluar berhasil dihapus.';

            } else {
                return redirect()->route('laporan.antrian')->with('error', 'Tipe antrian tidak valid.');
            }

            return redirect()->route('laporan.antrian')->with('success', $message);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('laporan.antrian')->with('error', 'Data tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('laporan.antrian')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
