<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Laporan Barang Terlaris</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <style>
        /* Warna utama */
        :root {
            --primary-maroon: #670D2F;
            --light-gray-bg: #f9f9f9;
            --border-color: #e0e0e0;
            --btn-hover-maroon: #500a25;
        }
        /* === Gaya untuk Form === */
        .card-form-custom { border: 1px solid var(--border-color); border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); overflow: hidden; }
        .card-form-custom .card-header { color: white; padding: 1rem 1.5rem; border-bottom: none; }
        .card-form-custom .card-header h5 { color: #670D2F; font-weight: 600; }
        .card-form-custom .card-body { padding: 1.5rem; }
        .card-form-custom .btn-primary { background-color: var(--primary-maroon); border-color: var(--primary-maroon); padding: 0.6rem 1.5rem; font-weight: 500; }
        .card-form-custom .btn-primary:hover { background-color: var(--btn-hover-maroon); border-color: var(--btn-hover-maroon); }
        .card-form-custom .form-control:focus, .card-form-custom .form-select:focus { border-color: var(--primary-maroon); box-shadow: 0 0 0 0.2rem rgba(103, 13, 47, 0.25); }
        /* === Gaya untuk Tabel === */
        .card-table-custom { border: 1px solid var(--border-color); border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); overflow: hidden; }
        .card-table-custom .card-header { background-color: #fff; padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); }
        .card-table-custom .card-header h5 { color: var(--primary-maroon); font-weight: 600; }
        .table.table-custom { border: none; }
        .table-custom thead tr { background-color: var(--primary-maroon); color: white; }
        .table-custom thead th { padding: 1rem; vertical-align: middle; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px; border: none; }
        .table-custom tbody td { padding: 1rem; vertical-align: middle; color: #333; border-top: 1px solid var(--border-color); }
        .table-custom tbody tr { background-color: white; transition: background-color 0.2s ease-in-out; }
        .table-custom tbody tr:hover { background-color: var(--light-gray-bg); }
        .table-custom tbody tr:first-child td { border-top: none; }
    </style>
</head>

<body>
    <div class="container-scroller d-flex">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                {{-- Pastikan ada pengguna yang sedang login --}}
                @auth

                    {{-- JIKA PENGGUNA ADALAH ADMIN --}}
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item sidebar-category">
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-view-dashboard menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                                <div class="badge badge-info badge-pill">Admin</div>
                            </a>
                        </li>

                        <li class="nav-item sidebar-category">
                            <p>Manajemen</p>
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('daftarAntrian.index') }}">
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                                <span class="menu-title">Data Antrian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.produk.tambah') }}">
                                <i class="mdi mdi-plus-box menu-icon"></i>
                                <span class="menu-title">Tambah Produk</span>
                            </a>
                        </li>

                        <li class="nav-item sidebar-category">
                            <p>Stok Barang</p>
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.barang.masuk') }}">
                                <i class="mdi mdi-truck-delivery menu-icon"></i>
                                <span class="menu-title">Barang Masuk</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#">
                                <i class="mdi mdi-truck-fast menu-icon"></i>
                                <span class="menu-title">Barang Keluar</span>
                            </a>
                        </li>

                        <li class="nav-item sidebar-category">
                            <p>Check Data</p>
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.produk.KadaluarsaProduk') }}">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Produk kadaluarsa</span>
                            </a>
                        </li>
                        <li class="nav-item sidebar-category">
                            <p>Pengguna</p>
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Kelola Pengguna</span>
                            </a>
                        </li>
                    @endif

                    {{-- JIKA PENGGUNA ADALAH MANAGER ATAU ADMIN --}}
                    @if (Auth::user()->role === 'manager' || Auth::user()->role === 'admin')
                        {{-- Jika rolenya manager, tampilkan dashboard manager --}}
                        @if (Auth::user()->role === 'manager')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('manager.dashboard') }}">
                                    <i class="mdi mdi-view-dashboard menu-icon"></i>
                                    <span class="menu-title">Dashboard</span>
                                    <div class="badge badge-success badge-pill">Manager</div>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item sidebar-category">
                            <p>Laporan</p>
                            <span></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false"
                                aria-controls="laporan">
                                <i class="mdi mdi-file-document-box-multiple menu-icon"></i>
                                <span class="menu-title">Laporan</span>
                                <i class="menu-arrow"></i>
                            </a>
                            <div class="collapse" id="laporan">
                                <ul class="nav flex-column sub-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_barang_masuk') }}">Laporan Barang
                                            Masuk</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_barang_keluar') }}">Laporan Barang
                                            Keluar</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_antrian') }}">Laporan Antrian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.produk.daftarproduk') }}">Laporan stok</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_barang_terlaris') }}">Laporan Barang
                                            Terlaku</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif

                @endauth
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;">LAPORAN BARANG TERLARIS</h4>
                    <div class="navbar-brand-wrapper">
                        <a class="navbar-brand brand-logo" href="index.html"><img
                                src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}"
                                width="120px" alt="logo" /></a>
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}"
                                alt="logo" /></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item">
                            <h4 class="mb-0 font-weight-bold d-none d-xl-block" id="tanggal-sekarang-js"></h4>
                        </li>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const el = document.getElementById('tanggal-sekarang-js');
                                if (el) {
                                    el.textContent = new Date().toLocaleDateString('id-ID', {
                                        weekday: 'long',
                                        day: '2-digit',
                                        month: 'long',
                                        year: 'numeric'
                                    });
                                }
                            });
                        </script>
                        <li class="nav-item dropdown me-2">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary me-2"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid mt-0">

                        <div class="card card-form-custom mb-4">
                            <div class="card-header">
                                <h5>Filter Laporan</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.laporan_barang_terlaris') }}" method="GET">
                                    <div class="row align-items-end">
                                        <div class="col-md-3">
                                            <label for="periode" class="form-label">Pilih Periode</label>
                                            <select name="periode" id="periode" class="form-select">
                                                <option value="harian" {{ $periode == 'harian' ? 'selected' : '' }}>Hari Ini</option>
                                                <option value="mingguan" {{ $periode == 'mingguan' ? 'selected' : '' }}>Minggu Ini</option>
                                                <option value="bulanan" {{ $periode == 'bulanan' ? 'selected' : '' }}>Bulan Ini</option>
                                                <option value="custom" {{ $periode == 'custom' ? 'selected' : '' }}>Tanggal Kustom</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" id="custom-date-range" style="{{ $periode == 'custom' ? '' : 'display: none;' }}">
                                            <div class="row">
                                                <div class="col">
                                                    <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                                                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ $tanggal_mulai ?? '' }}">
                                                </div>
                                                <div class="col">
                                                    <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ $tanggal_akhir ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary w-100">Terapkan Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card card-table-custom">
                            <div class="card-header">
                                <h5>{{ $title }}</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-custom">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Total Terjual</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($barangLaku as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->total_terjual }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Tidak ada data penjualan pada periode ini.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#periode').on('change', function() {
                if ($(this).val() === 'custom') {
                    $('#custom-date-range').show();
                } else {
                    $('#custom-date-range').hide();
                }
            });
        });
    </script>
</body>
</html>