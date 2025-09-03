<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarAntrian; // Pastikan Anda mengimpor model yang benar
use App\Models\Produk;         // Impor model Produk
use App\Models\BarangMasuk;    // Impor model BarangMasuk
use Carbon\Carbon;             // Impor Carbon untuk manipulasi tanggal
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk manajer.
     */
    public function dashboard(Request $request) // Menambahkan Request $request adalah praktik yang baik
    {
        $user = Auth::user();
        $jumlahAntrianPending = 0;
        $jumlahAntrianSelesaiHariIni = 0;
        $jumlahProdukKadaluarsaBulanIni = 0;

        if ($user) { // Hanya hitung jika user sudah login
            // 1. Ambil jumlah antrian dengan status 'pending' untuk hari ini
            $jumlahAntrianPending = DaftarAntrian::where('status', 'pending')
                ->whereDate('tanggal_permintaan', today())
                ->count();

            // 2. Ambil jumlah antrian dengan status 'selesai' untuk hari ini
            // Asumsi status selesai adalah 'selesai'
            // Asumsi tanggal penyelesaian dicatat di 'diproses_pada'
            $jumlahAntrianSelesaiHariIni = DaftarAntrian::where('status', 'selesai') // Ganti 'selesai' jika status Anda berbeda
                ->whereDate('diproses_pada', today()) // Pastikan kolom tanggal ini benar
                ->count();

            // 3. Ambil jumlah item (batch) di BarangMasuk yang tanggal kedaluwarsanya jatuh pada bulan ini
            $tanggalAwalBulanIni = Carbon::now()->startOfMonth();
            $tanggalAkhirBulanIni = Carbon::now()->endOfMonth();

            // Menghitung berapa banyak batch/catatan di barang_masuk yang kedaluwarsa bulan ini.
            $jumlahProdukKadaluarsaBulanIni = BarangMasuk::whereBetween('tanggal_kedaluwarsa', [$tanggalAwalBulanIni, $tanggalAkhirBulanIni])
                // Catatan: Jika Anda perlu mempertimbangkan sisa stok per batch,
                // Anda memerlukan kolom seperti 'sisa_stok_batch' di tabel 'barang_masuk'
                // dan menambahkan kondisi seperti ->where('sisa_stok_batch', '>', 0)
                ->count();

            /*
            // Alternatif untuk Produk Kadaluwarsa (pilih salah satu sesuai kebutuhan):

            // A. Total UNIT produk yang kadaluwarsa bulan ini:
            // $totalUnitProdukKadaluarsaBulanIni = BarangMasuk::whereBetween('tanggal_kedaluwarsa', [$tanggalAwalBulanIni, $tanggalAkhirBulanIni])
            // ->sum('jumlah');
            // Jika menggunakan ini, kirim '$totalUnitProdukKadaluarsaBulanIni' ke view.

            // B. Jumlah JENIS PRODUK (dari tabel produk) yang memiliki batch kadaluwarsa bulan ini:
            // (Memerlukan 'use App\Models\Produk;')
            // $jumlahJenisProdukDenganItemKadaluarsaBulanIni = \App\Models\Produk::whereHas('barangMasuks', function ($query) use ($tanggalAwalBulanIni, $tanggalAkhirBulanIni) {
            // $query->whereBetween('tanggal_kedaluwarsa', [$tanggalAwalBulanIni, $tanggalAkhirBulanIni]);
            // })->count();
            // Jika menggunakan ini, kirim '$jumlahJenisProdukDenganItemKadaluarsaBulanIni' ke view.
            */
        }

        // Kirim semua data ke view 'manager.dashboard'
             return view('manager.dashboard', [ // Pastikan path view Anda benar (misalnya 'admin.dashboard.index' atau hanya 'admin.dashboard')
            'user' => $user,
            'jumlahAntrianPending' => $jumlahAntrianPending,
            'jumlahAntrianSelesaiHariIni' => $jumlahAntrianSelesaiHariIni,
            'jumlahProdukKadaluarsaBulanIni' => $jumlahProdukKadaluarsaBulanIni,
            // Jika menggunakan alternatif, tambahkan variabelnya di sini, contoh:
            // 'totalUnitProdukKadaluarsaBulanIni' => $totalUnitProdukKadaluarsaBulanIni ?? 0,
        ]);
    }
}