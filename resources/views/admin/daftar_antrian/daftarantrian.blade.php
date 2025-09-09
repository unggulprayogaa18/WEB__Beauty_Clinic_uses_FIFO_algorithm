<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - Daftar Antrian</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <style>
        /* ==============================================
         == KODE CSS KUSTOM UNTUK HALAMAN DAFTAR ANTRIAN ==
         ==============================================
        */

        /* Variabel Warna Utama */
        :root {
            --primary-maroon: #670D2F;
            --light-maroon-bg: #fdf6f8;
            --light-gray-bg: #f9fafb;
            --border-color: #e5e7eb;
            --text-dark: #1f2937;
            --text-light: #6b7280;
        }

        /* Card Wrapper Utama */
        .card.card-custom {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Header Card */
        .card-custom .card-header {
            background-color: #ffffff;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-custom .card-header .card-title {
            color: var(--primary-maroon);
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
        }

        /* Input Pencarian */
        .search-wrapper {
            width: 100%;
            max-width: 350px;
        }

        .search-input {
            border-radius: 8px !important;
            border: 1px solid #d1d5db !important;
            padding: 0.75rem 1rem !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .search-input:focus {
            border-color: var(--primary-maroon) !important;
            box-shadow: 0 0 0 3px rgba(103, 13, 47, 0.1) !important;
            outline: none;
        }

        /* Tabel Kustom */
        .table.table-custom {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead tr {
            background-color: var(--light-maroon-bg);
        }

        .table-custom thead th {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border: none;
            color: var(--primary-maroon);
            font-weight: 600;
        }

        .table-custom tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            color: var(--text-dark);
            border-top: 1px solid var(--border-color);
        }

        .table-custom tbody tr {
            background-color: white;
            transition: background-color 0.2s ease-in-out;
        }

        .table-custom tbody tr:hover {
            background-color: var(--light-gray-bg);
        }

        .table-custom tbody tr:first-child td {
            border-top: none;
        }

        /* Badge Kustom */
        .table-custom .badge {
            font-size: 0.75rem;
            padding: 0.5em 0.9em;
            border-radius: 20px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .table-custom .badge-warning {
            background-color: #fffbeb;
            color: #b45309;
        }

        .table-custom .badge-success {
            background-color: #f0fdf4;
            color: #15803d;
        }

        .table-custom .badge-danger {
            background-color: #fef2f2;
            color: #b91c1c;
        }

        .table-custom .badge-info {
            background-color: #eff6ff;
            color: #1d4ed8;
        }

        .table-custom .badge-secondary {
            background-color: #f3f4f6;
            color: #4b5563;
        }

        /* Tombol Aksi */
        .btn-action {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
            border-radius: 6px;
        }

        /* Catatan */
        .note-text {
            font-style: italic;
            color: var(--text-light);
            font-size: 0.85rem;
            max-width: 250px;
            /* Batasi lebar agar tidak terlalu panjang */
            white-space: normal;
        }
    </style>
</head>

<body>
    <div class="container-scroller d-flex">
        <!-- partial:./partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.barang.keluar') }}">
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
                        <i class="mdi mdi-calendar-remove menu-icon"></i>
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
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.laporan_barang_masuk') }}">Laporan Barang Masuk</a> </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.laporan_barang_keluar') }}">Laporan Barang Keluar</a> </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.laporan_antrian') }}">Laporan Antrian</a> </li>
                            <li class="nav-item"> <a class="nav-link"
                                    href="{{ route('admin.produk.daftarproduk') }}">Laporan Stok</a> </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.laporan_barang_terlaris') }}">Laporan Barang
                                    Terlaku</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:./partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <div class="navbar-brand-wrapper">
                        <a class="navbar-brand brand-logo" href="index.html"><img
                                src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}"
                                width="120px" alt="logo" /></a>
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img
                                src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}"
                                alt="logo" /></a>
                    </div>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1 ms-4">Sistem Manajemen Inventaris</h4>
                    <ul class="navbar-nav navbar-nav-right ms-auto">
                        <li class="nav-item">
                            <h4 class="mb-0 font-weight-bold d-none d-xl-block" id="tanggal-sekarang-js"></h4>
                        </li>
                        <li class="nav-item dropdown me-2">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    title="Logout">
                                    <i class="mdi mdi-logout-variant text-primary me-2"></i>
                                    <span class="d-none d-md-block">Logout</span>
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
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    @if(session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                    @endif
                    @if(session('warning'))
                        <div class="alert alert-warning" role="alert">{{ session('warning') }}</div>
                    @endif

                    <div class="card card-custom">
                        <div class="card-header">
                            <h5 class="card-title">Daftar Antrian Hari Ini</h5>
                            <div class="search-wrapper">
                                <input type="text" id="searchInput" class="form-control search-input"
                                    placeholder="Cari antrian...">
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom" id="antrianTable">
                                    <thead>
                                        <tr>
                                            <th>No. Antrian</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Tgl. Permintaan</th>
                                            <th>Tgl. Kedaluwarsa (FIFO)</th>
                                            <th>Status</th>
                                            <th>Catatan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($antrians as $antrian)
                                            <tr>
                                                <td><strong>{{ $antrian->nomer_antrian ?: '-' }}</strong></td>
                                                <td>
                                                    <div>{{ $antrian->produk ? $antrian->produk->nama_produk : 'N/A' }}
                                                    </div>
                                                    <small class="text-muted">ID: {{ $antrian->id_produk }}</small>
                                                </td>
                                                <td>{{ $antrian->jumlah_diminta }}</td>
                                                <td>{{ $antrian->tanggal_permintaan ? \Carbon\Carbon::parse($antrian->tanggal_permintaan)->format('d M Y') : '-' }}
                                                </td>
                                                <td>
                                                    @if (isset($antrian->tanggal_kedaluwarsa_fifo))
                                                        @php
                                                            $tgl_kedaluwarsa = \Carbon\Carbon::parse($antrian->tanggal_kedaluwarsa_fifo);
                                                            $isExpiringSoon = $tgl_kedaluwarsa->isBefore(now()->addMonth());
                                                        @endphp
                                                        <span class="{{ $isExpiringSoon ? 'text-danger fw-bold' : '' }}">
                                                            {{ $tgl_kedaluwarsa->format('d M Y') }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">Stok Habis</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($antrian->status == 'pending')
                                                        <span class="badge badge-warning">Pending</span>
                                                    @elseif($antrian->status == 'diproses')
                                                        <span class="badge badge-info">Diproses</span>
                                                    @elseif($antrian->status == 'gagal')
                                                        <span class="badge badge-danger">Gagal</span>
                                                    @elseif($antrian->status == 'selesai')
                                                        <span class="badge badge-success">Selesai</span>
                                                    @else
                                                        <span
                                                            class="badge badge-secondary">{{ ucfirst($antrian->status) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="note-text">{{ $antrian->catatan_gagal ?: '-' }}</div>
                                                </td>
                                                <td>
                                                    @if(in_array($antrian->status, ['pending', 'gagal']))
                                                        <form action="{{ route('daftarAntrian.process', $antrian->id) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Anda yakin ingin memproses antrian ini?');">
                                                            @csrf
                                                            <input type="hidden" name="id_produk"
                                                                value="{{ $antrian->id_produk }}">
                                                            <input type="hidden" name="jumlah_diminta"
                                                                value="{{ $antrian->jumlah_diminta }}">
                                                            <button type="submit" class="btn btn-primary btn-sm btn-action"
                                                                title="Proses Antrian">
                                                                <i class="mdi mdi-cogs"></i> Proses
                                                            </button>
                                                        </form>
                                                    @elseif($antrian->status == 'selesai')
                                                        <button class="btn btn-success btn-sm btn-action" disabled>
                                                            <i class="mdi mdi-check-circle"></i> Selesai
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <i class="mdi mdi-information-outline mdi-24px text-muted"></i>
                                                    <p class="mt-2 text-muted">Tidak ada data antrian untuk hari ini.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-center">
                                {{ $antrians->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- base:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Skrip untuk menampilkan tanggal hari ini
            const elemenTanggal = document.getElementById('tanggal-sekarang-js');
            if (elemenTanggal) {
                const opsiFormat = {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                };
                const tanggalFormatted = new Date().toLocaleDateString('id-ID', opsiFormat);
                elemenTanggal.textContent = tanggalFormatted;
            }

            // Skrip untuk fungsionalitas pencarian tabel
            // Hanya akan mencari di halaman yang sedang aktif (client-side)
            const searchInput = document.getElementById('searchInput');
            const table = document.getElementById('antrianTable');
            const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

            if (searchInput) {
                searchInput.addEventListener('keyup', function () {
                    const searchTerm = searchInput.value.toLowerCase();

                    for (let i = 0; i < tableRows.length; i++) {
                        const row = tableRows[i];
                        // Pastikan tidak menarget baris 'data tidak ditemukan'
                        if (row.getElementsByTagName('td').length > 1) {
                            const rowText = row.textContent.toLowerCase();
                            if (rowText.includes(searchTerm)) {
                                row.style.display = '';
                            } else {
                                row.style.display = 'none';
                            }
                        }
                    }
                });
            }
        });
    </script>
    <!-- End custom js for this page-->
</body>

</html>