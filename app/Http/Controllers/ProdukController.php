<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Produk;
use Illuminate\Http\Request;


class ProdukController extends Controller
{
    public function index()
    {
        // Ambil data produk dengan paginasi (misal 10 item per halaman)
        $produks = Produk::orderBy('created_at', 'desc')->paginate(10); // Urutkan berdasarkan terbaru
        return view('admin.produk.tambah', compact('produks'));
    }

    public function indexDaftarProduk()
    {
        // Ambil data produk dengan relasi barangMasuks dan total stoknya
        $produks = Produk::with('barangMasuks') // Eager load detail barangMasuks
            ->withSum('barangMasuks as total_stok', 'jumlah') // Menghitung total stok dan menamakannya 'total_stok'
            ->orderBy('nama_produk', 'asc') // Urutkan berdasarkan nama produk
            ->paginate(10); // Paginasi

        // Sekarang setiap objek $produk akan memiliki atribut 'total_stok'
        // yang berisi jumlah total dari kolom 'jumlah' pada relasi 'barangMasuks'.
        // Jika tidak ada barang masuk, 'total_stok' akan bernilai 0 (atau null tergantung versi Laravel/DB).
        // Relasi $produk->barangMasuks juga tetap tersedia untuk detail per batch.

        return view('admin.produk.daftarproduk', compact('produks'));
    }

    public function indexKadaluarsaProduk()
    {
        $produks = Produk::with([
            'barangMasuks' => function ($query) {
                $query->where('jumlah', '>', 0)->orderBy('tanggal_kedaluwarsa', 'asc');
            }
        ])
            ->withSum([
                'barangMasuks' => function ($query) {
                    $query->where('jumlah', '>', 0);
                }
            ], 'jumlah', 'total_stok')
            ->orderBy(
                BarangMasuk::select('tanggal_kedaluwarsa')
                    ->whereColumn('barang_masuk.id_produk', 'produk.id_produk')
                    ->where('barang_masuk.jumlah', '>', ' 0')
                    ->orderBy('tanggal_kedaluwarsa', 'asc')
                    ->limit(1),
                'asc'
            )
            ->orderBy('produk.nama_produk', 'asc')->paginate(10);

        return view('admin.produk.kadaluarsa', compact('produks'));
    }
    public function create()
    {
        return view('admin.produk.tambah');
    }

    // Fungsi simpan data produk
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|max:100',
            'kategori' => 'required|max:50',
        ]);

        // Hitung total produk untuk menentukan nomor urut
        $count = Produk::count() + 1;
        $kodeUrut = str_pad($count, 3, '0', STR_PAD_LEFT); // hasil: 001, 002, dst.

        // Format nama produk (hapus spasi, huruf kecil semua, bisa disesuaikan)
        $namaFormatted = str_replace(' ', '_', $request->nama_produk);

        // Buat ID Produk
        $id_produk = $kodeUrut . '_' . $namaFormatted;

        // Simpan ke database
        Produk::create([
            'id_produk' => $id_produk,
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
        ]);

        // Redirect balik dengan pesan
        return redirect()->back()->with('success', 'Produk berhasil disimpan!');
    }
    public function update(Request $request, $id_produk_from_route) // Or (Request $request, Produk $produk)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            // id_produk_hidden is not usually validated as it's for identifying the record
        ]);

        // If not using Route Model Binding, find the product first:
        $produk = Produk::findOrFail($id_produk_from_route); // Using the ID from the route
        // Or, if you passed id_produk_hidden from the form and want to use that:
        // $produk = Produk::findOrFail($request->id_produk_hidden);


        $produk->nama_produk = $request->nama_produk;
        $produk->kategori = $request->kategori;
        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
    public function destroy(Produk $produk)
    {
        // The 'Produk $produk' part uses Route-Model Binding.
        // Laravel automatically finds the product with the given ID.

        try {
            // Delete the product from the database
            $produk->delete();

            // Redirect back to the product list with a success message
            return redirect()->route('admin.produk.tambah')->with('success', 'Produk berhasil dihapus!');

        } catch (\Exception $e) {
            // If there's an error (e.g., database constraint), redirect with an error message
            return redirect()->route('admin.produk.tambah')->with('error', 'Gagal menghapus produk. Mungkin produk ini masih digunakan di data lain.');
        }
    }
}
