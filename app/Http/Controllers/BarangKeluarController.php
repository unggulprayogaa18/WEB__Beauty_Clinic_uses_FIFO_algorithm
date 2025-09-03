<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DaftarAntrian;
use App\Models\Produk; // Pastikan model Produk ada
use Illuminate\Support\Facades\DB; // Pastikan DB facade di-import untuk transaksi
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator; // Untuk validasi
use Illuminate\Support\Str; // Jika ingin generate ID unik secara sederhana

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Di dalam method index() controller Anda
   public function index(Request $request)
    {
        $barangKeluars = BarangKeluar::with('produk')->latest()->paginate(10);

        $produks = Produk::select('*')
            ->withSum('barangMasuks as total_stok', 'jumlah')
            
            // Mengambil tanggal kedaluwarsa dari batch paling lama (FIFO)
            ->addSelect(['fifo_kedaluwarsa' => BarangMasuk::select('tanggal_kedaluwarsa')
                ->whereColumn('id_produk', 'produk.id_produk') 
                ->where('jumlah', '>', 0)
                ->orderBy('tanggal_masuk', 'asc')
                ->limit(1)
            ])
            
            ->whereHas('barangMasuks', function ($query) {
                $query->where('jumlah', '>', 0);
            })
            ->orderBy('nama_produk')
            ->get();
            
        $barangMasuks = BarangMasuk::with('produk')->latest()->get(); 

        $barangKeluarToEdit = session('barangKeluarToEdit');

        return view('admin.barang_keluar.barangkeluar', compact('barangKeluars', 'produks', 'barangMasuks', 'barangKeluarToEdit'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.barang_keluar.create', compact('produks')); // Sesuaikan path view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required|string|max:20|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.barang.keluar')
                ->withErrors($validator)
                ->withInput();
        }

        $produk = Produk::find($request->id_produk);

        if (!$produk) {
            return redirect()->route('admin.barang.keluar')
                ->withErrors(['id_produk' => 'Produk tidak ditemukan.'])
                ->withInput();
        }

        $stokSaatIniDariBatch = $produk->barangMasuks()->sum('jumlah');

        if ($stokSaatIniDariBatch < $request->jumlah) {
            return redirect()->route('admin.barang.keluar')
                ->withErrors(['jumlah' => 'Jumlah keluar (' . $request->jumlah . ') melebihi stok yang tersedia. Stok produk "' . $produk->nama_produk . '" saat ini (dari batch masuk): ' . $stokSaatIniDariBatch])
                ->withInput();
        }

        DaftarAntrian::create([
            'id_produk' => $request->id_produk,
            'jumlah_diminta' => $request->jumlah,
            'tanggal_permintaan' => $request->tanggal_keluar, 
            'status' => 'pending',
      
        ]);

        $prefix = 'BK-';
        $datePart = now()->format('Ymd');
        $lastToday = BarangKeluar::where('id_keluar', 'LIKE', $prefix . $datePart . '-%')
            ->orderBy('id_keluar', 'desc')
            ->first();
        $sequence = 1;
        if ($lastToday) {
            $lastSequence = (int) substr($lastToday->id_keluar, -4);
            $sequence = $lastSequence + 1;
        }
        $sequentialPart = str_pad($sequence, 4, '0', STR_PAD_LEFT);
        $id_keluar_generated = $prefix . $datePart . '-' . $sequentialPart;

        while (BarangKeluar::where('id_keluar', $id_keluar_generated)->exists()) {
            $sequence++;
            $sequentialPart = str_pad($sequence, 4, '0', STR_PAD_LEFT);
            $id_keluar_generated = $prefix . $datePart . '-' . $sequentialPart;
        }

        DB::beginTransaction();
        try {

            // 2. Buat record barang keluar
            BarangKeluar::create([
                'id_keluar' => $id_keluar_generated,
                'id_produk' => $request->id_produk,
                'jumlah' => $request->jumlah, 
                'tanggal_keluar' => $request->tanggal_keluar,
            ]);

            DB::commit();

            return redirect()->route('admin.barang.keluar.index')
                ->with('success', 'Data barang keluar berhasil ditambahkan dan stok barang masuk telah diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.barang.keluar')
                ->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangKeluar $barangKeluar) 
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar) // Route model binding
    {
        $produks = Produk::orderBy('nama_produk')->get();
        return view('admin.barang_keluar.edit', compact('barangKeluar', 'produks')); // Sesuaikan path view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar) 
    {
        $validator = Validator::make($request->all(), [
            'id_produk' => 'required|string|max:20|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.barang.keluar.edit', $barangKeluar->id_keluar) 
                ->withErrors($validator)
                ->withInput();
        }

        $produk = Produk::find($request->id_produk);
        $jumlahLama = $barangKeluar->jumlah; 
        $jumlahBaru = $request->jumlah;
        $perubahanJumlah = $jumlahBaru - $jumlahLama; 

        // Cek stok jika produknya sama atau produknya beda
        if ($barangKeluar->id_produk == $request->id_produk) {
            if ($produk->stok + $jumlahLama < $jumlahBaru) { 
                return redirect()->route('admin.barang.keluar.edit', $barangKeluar->id_keluar)
                    ->withErrors(['jumlah' => 'Jumlah keluar melebihi stok yang tersedia. Stok saat ini (sebelum perubahan): ' . $produk->stok])
                    ->withInput();
            }
        } else {
            $produkLama = Produk::find($barangKeluar->id_produk);
            if ($produkLama) {
                $produkLama->stok += $jumlahLama; 
                $produkLama->save();
            }
            if (!$produk || $produk->stok < $jumlahBaru) {
                return redirect()->route('admin.barang.keluar.edit', $barangKeluar->id_keluar)
                    ->withErrors(['jumlah' => 'Jumlah keluar untuk produk baru melebihi stok yang tersedia. Stok saat ini: ' . ($produk ? $produk->stok : 0)])
                    ->withInput();
            }
        }


        $barangKeluar->update($request->all());

        if ($barangKeluar->id_produk == $request->id_produk) {
            $produk->stok -= $perubahanJumlah; 
        } else {
            $produk->stok -= $jumlahBaru;
        }
        $produk->save();


        return redirect()->route('admin.barang.keluar.index')
            ->with('success', 'Data barang keluar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar) 
    {
        DB::beginTransaction(); 

        try {
 
            $idProdukTarget = $barangKeluar->id_produk;
            $createdAtTarget = $barangKeluar->created_at; 
            $jumlahKeluar = $barangKeluar->jumlah; 

            $deletedAntriansCount = DaftarAntrian::where('id_produk', $idProdukTarget)
                ->where('created_at', $createdAtTarget)
                ->delete();

            if ($deletedAntriansCount > 0) {
                Log::info($deletedAntriansCount . ' record DaftarAntrian terkait BarangKeluar ID ' . $barangKeluar->id_keluar . ' telah dihapus.');
            } else {
                Log::info('Tidak ada record DaftarAntrian yang cocok untuk dihapus terkait BarangKeluar ID ' . $barangKeluar->id_keluar . ' (id_produk: ' . $idProdukTarget . ', created_at: ' . $createdAtTarget->toDateTimeString() . ')');
            }

      
            $barangKeluar->delete();

            DB::commit(); 

            return redirect()->route('admin.barang.keluar') 
                ->with('success', 'Data barang keluar dan antrian terkait berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack(); 
            Log::error('Gagal menghapus barang keluar (ID: ' . $barangKeluar->id_keluar . ') dan/atau antrian terkait: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());

            return redirect()->route('admin.barang.keluar') 
                ->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi atau hubungi administrator.');
        }
    }
}