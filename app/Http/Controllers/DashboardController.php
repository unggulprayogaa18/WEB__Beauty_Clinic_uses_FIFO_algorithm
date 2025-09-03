<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\DaftarAntrian; // Pastikan model DaftarAntrian sudah di-import
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang login

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        
        $user = Auth::user();
        $jumlahAntrianPending = 0; // Default value

        // Ambil jumlah antrian pending jika user adalah admin
        // Anda bisa menyesuaikan logika ini jika role lain juga perlu melihatnya
        // atau jika semua role bisa melihatnya.
        if ($user) { // Cek apakah user sudah login
            // Ambil jumlah antrian dengan status 'pending' untuk hari ini
            // Asumsi 'status' adalah kolom di tabel daftar_antrians
            // dan 'pending' adalah salah satu nilai statusnya.
            // Asumsi 'tanggal_permintaan' adalah kolom tanggal di tabel daftar_antrians
            $jumlahAntrianPending = DaftarAntrian::where('status', 'pending')
                ->whereDate('tanggal_permintaan', today()) // Hanya antrian hari ini
                ->count();
        }

        // Jika user adalah admin, redirect ke dashboard admin
        // Kode ini sebaiknya diletakkan di middleware atau di awal method controller yang relevan
        // Jika Anda ingin ini terjadi setelah login, letakkan di LoginController
        // if ($user && $user->role === 'admin') {
        // return redirect('/admin/dashboard');
        // }
        // Jika kode di atas tetap di sini, pastikan $jumlahAntrianPending juga dikirim ke admin dashboard
        // atau admin dashboard memiliki logikanya sendiri.

        return view('dashboard.index', [ // Ganti 'dashboard.index' dengan nama view Anda
            'jumlahAntrianPending' => $jumlahAntrianPending,
            'user' => $user // Kirim juga data user jika diperlukan di view
        ]);
    }

    // Jika Anda punya dashboard khusus admin, bisa seperti ini:
    public function adminDashboard()
    {
        $jumlahAntrianPending = DaftarAntrian::where('status', 'pending')
            ->whereDate('tanggal_permintaan', today())
            ->count();

        // Data lain untuk admin dashboard
        // ...

        return view('admin.dashboard.index', [ // Ganti 'admin.dashboard.index' dengan nama view admin Anda
            'jumlahAntrianPending' => $jumlahAntrianPending,
        ]);
    }
}