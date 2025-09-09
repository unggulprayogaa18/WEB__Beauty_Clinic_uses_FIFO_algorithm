<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('login.login');
});

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManagerController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [App\Http\Controllers\ForgotPasswordController::class, 'sendResetLinkWhatsApp'])->name('password.send.otp');
Route::get('reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'showResetForm'])->name('password.reset.form');
Route::post('reset-password', [App\Http\Controllers\ForgotPasswordController::class, 'reset'])->name('password.update');

// Contoh route dashboard berdasarkan role
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'role:admin']);



Route::get('/manager/dashboard', [ManagerController::class, 'dashboard'])
    ->name('manager.dashboard') // Memberi nama route adalah praktik yang baik
    ->middleware(['auth', 'role:manager']);

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Data Antrian
Route::get('/admin/antrian', [AdminController::class, 'antrian'])->name('admin.antrian');

// Daftar Produk
Route::get('/admin/produk', [ProdukController::class, 'create'])->name('admin.produk');

// Tambah Produk
Route::get('/admin/produk/tambah', [ProdukController::class, 'index'])->name('admin.produk.tambah');

Route::get('/admin/produk/daftarproduk', [ProdukController::class, 'indexDaftarProduk'])->name('admin.produk.daftarproduk');

Route::get('/admin/produk/KadaluarsaProduk', [ProdukController::class, 'indexKadaluarsaProduk'])->name('admin.produk.KadaluarsaProduk');

// Kelola Pengguna
Route::get('/admin/kelola-pengguna', [AdminController::class, 'kelolaPengguna'])->name('admin.kelola_pengguna');

// Laporan
Route::get('/admin/laporan/barang-masuk', [LaporanController::class, 'barangMasuk'])->name('admin.laporan_barang_masuk');
Route::get('/admin/laporan/barang-keluar', [LaporanController::class, 'barangKeluar'])->name(name: 'admin.laporan_barang_keluar');
Route::get('/admin/laporan/antrian', [LaporanController::class, 'Antrian'])->name('admin.laporan_antrian');
// TAMBAHKAN ROUTE BARU DI SINI
Route::get('/admin/laporan/barang-terlaris', [LaporanController::class, 'barangTerlaris'])->name('admin.laporan_barang_terlaris');

// routes/web.php// routes/web.php
// routes/web.php
// Route for the main dashboard view
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route for fetching annual/monthly stock data for the chart
Route::get('/api/stock-data', [DashboardController::class, 'getStockData'])->name('api.stock.data');

// ... (route lain yang Anda miliki) ...
Route::get('/chart-data', [DashboardController::class, 'getChartData']);
Route::delete('/antrian/{tipe}/{id}', [LaporanController::class, 'destroyAntrian'])->name('antrian.destroy');

Route::get('/laporan/antrian', [LaporanController::class, 'Antrian'])->name('laporan.antrian');
Route::prefix('admin')->name('admin.')->middleware(['auth' /* , 'isAdmin' // Tambahkan middleware untuk role admin */])->group(function () {

    // Dashboard (contoh)
    // Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Manajemen Pengguna
    Route::get('users', [UserController::class, 'index'])->name('users.index'); // Menampilkan form & tabel
    Route::post('users', [UserController::class, 'store'])->name('users.store'); // Menyimpan pengguna baru
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update'); // Mengupdate pengguna
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Menghapus pengguna

    // Anda bisa juga menggunakan Route::resource jika semua method standar ada:
    // Route::resource('users', UserController::class)->except(['show', 'create', 'edit']); 
    // 'except' jika Anda tidak menggunakan method show, create, edit standar dari resource.
    // Untuk kasus ini, karena form create/edit ada di halaman index, kita definisikan manual.

    // ... route admin lainnya ...
});


Route::resource('produk', ProdukController::class);

// For creating a new product
Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');

// For updating an existing product
// Make sure the parameter name {produk} matches what your controller expects,
// or adjust your controller's update method signature.
// If you use Route Model Binding and your model's route key is 'id_produk',
// Laravel will automatically fetch the Produk model.
// Route::put('/produk/{produk}', [ProdukController::class, 'update'])->name('produk.update');

// Your other produk routes (index, edit, destroy, etc.)
Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])->name('produk.edit'); // This might now be less used if edit is inline
Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])->name('produk.destroy');


use App\Http\Controllers\BarangMasukController;

// ... route lainnya

Route::resource('barang-masuk', BarangMasukController::class);// routes/web.php


Route::get('/admin/barang-masuk', [BarangMasukController::class, 'index'])->name('admin.barang.masuk');



Route::prefix('admin')->name('admin.')->middleware(['auth' /* ...middleware lain jika ada */])->group(function () {
    Route::get('barang-masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
    Route::post('barang-masuk', [BarangMasukController::class, 'store'])->name('barang.masuk.store');
    Route::get('barang-masuk/{barangMasuk}/edit-data', [BarangMasukController::class, 'edit'])->name('barang.masuk.edit_data'); // Untuk AJAX get data edit
    Route::put('barang-masuk/{barangMasuk}', [BarangMasukController::class, 'update'])->name('barang.masuk.update');
    Route::delete('barang-masuk/{barangMasuk}', [BarangMasukController::class, 'destroy'])->name('barang.masuk.destroy');
});



use App\Http\Controllers\BarangKeluarController;

Route::prefix('admin')->name('admin.')->group(function () {


    // Route untuk Barang Keluar
    Route::resource('barang-keluar', BarangKeluarController::class)->names([
        'index' => 'barang.keluar',       // Ini akan menghasilkan nama route: admin.barang.keluar
        'create' => 'barang.keluar.create',  // Nama route: admin.barang.keluar.create
        'store' => 'barang.keluar.store',   // Nama route: admin.barang.keluar.store
        'show' => 'barang.keluar.show',    // Nama route: admin.barang.keluar.show
        'edit' => 'barang.keluar.edit',    // Nama route: admin.barang.keluar.edit
        'update' => 'barang.keluar.update',  // Nama route: admin.barang.keluar.update
        'destroy' => 'barang.keluar.destroy', // Nama route: admin.barang.keluar.destroy
    ]);
});
use App\Http\Controllers\AntrianController;
// Routes untuk Daftar Antrian
Route::get('daftar-antrian', [AntrianController::class, 'index'])->name('daftarAntrian.index');

// Route untuk memproses antrian (jika Anda sudah memiliki method 'process' di controller)
// Method-nya POST karena akan mengubah data (memproses antrian)
Route::post('daftar-antrian/{antrian}/process', [AntrianController::class, 'process'])->name('daftarAntrian.process');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // ... route admin lainnya ...
    Route::post('daftar-antrian/process/{id}', [AntrianController::class, 'process'])->name('daftarAntrian.process');
    Route::get('daftar-antrian', [AntrianController::class, 'index'])->name('daftarAntrian.index'); // Pastikan route index juga ada
});
