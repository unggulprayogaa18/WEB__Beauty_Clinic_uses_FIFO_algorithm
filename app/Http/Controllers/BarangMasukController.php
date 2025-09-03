<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ViewErrorBag;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $barangMasuks = BarangMasuk::with('produk')->latest()->paginate(10);
        $produks = Produk::orderBy('nama_produk')->get();

        $barangMasukToEdit = null;
        $idToEditOnError = $request->query('edit_failed_id');
        $sessionErrors = $request->session()->get('errors');

        if (
            $idToEditOnError
            && $request->old('_method') === 'PUT'
            && $sessionErrors instanceof ViewErrorBag
            && $sessionErrors->hasBag('update')
        ) {
            // hanya tandai bahwa kita sudah mencoba update tapi gagal
            $barangMasukToEdit = new BarangMasuk();
            $barangMasukToEdit->id_masuk = $idToEditOnError;
        }

        return view('admin.barang_masuk.barangmasuk', compact('barangMasuks', 'produks', 'barangMasukToEdit'));
    }

    public function edit(BarangMasuk $barangMasuk)
    {
        return response()->json($barangMasuk->load('produk'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Ganti “produks” → “produk”:
            'id_produk' => 'required|string|max:20|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'tanggal_kedaluwarsa' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.barang.masuk')
                ->withErrors($validator)
                ->withInput()
                ->with('error_form_type', 'store');
        }

        // Buat ID_MASUK yang unik
        $prefix = 'BM-';
        $datePart = now()->format('Ymd');
        $countToday = BarangMasuk::whereDate('created_at', today())->count() + 1;
        $sequentialPart = str_pad($countToday, 4, '0', STR_PAD_LEFT);
        $id_masuk_generated = $prefix . $datePart . '-' . $sequentialPart;

        while (BarangMasuk::where('id_masuk', $id_masuk_generated)->exists()) {
            $countToday++;
            $sequentialPart = str_pad($countToday, 4, '0', STR_PAD_LEFT);
            $id_masuk_generated = $prefix . $datePart . '-' . $sequentialPart;
        }

        BarangMasuk::create([
            'id_masuk' => $id_masuk_generated,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
        ]);

        return redirect()->route('admin.barang.masuk')
            ->with('success', 'Data barang masuk berhasil ditambahkan.');
    }

    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $validator = Validator::make($request->all(), [
            // Hapus '_edit' dari nama field
            'id_produk' => 'required|string|max:20|exists:produk,id_produk',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            // Perbaiki juga referensi field di sini
            'tanggal_kedaluwarsa' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.barang.masuk', ['edit_failed_id' => $barangMasuk->id_masuk])
                ->withErrors($validator, 'update') // 'update' adalah named error bag
                ->withInput()
                ->with('error_form_type', 'update');
        }

        // Gunakan nama field yang sama dari request
        $barangMasuk->update([
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
            'tanggal_kedaluwarsa' => $request->tanggal_kedaluwarsa,
        ]);

        return redirect()->route('admin.barang.masuk')
            ->with('success', 'Data barang masuk berhasil diperbarui.');
    }

    public function destroy(BarangMasuk $barangMasuk)
    {
        try {
            $barangMasuk->delete();
            return redirect()->route('admin.barang.masuk')
                ->with('success', 'Data barang masuk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.barang.masuk')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
