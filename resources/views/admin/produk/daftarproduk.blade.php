<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Spica Admin</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller d-flex">
        <div class="row p-0 m-0 proBanner" id="proBanner">
            <div class="col-md-12 p-0 m-0">
                <!-- <div class="card-body card-body-padding d-flex align-items-center justify-content-between"> -->
                <!-- <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
              <a href="https://www.bootstrapdash.com/product/spica-admin/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
            </div>
          </div> -->
                <!-- <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/spica-admin/"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white mr-0"></i>
            </button>
          </div> -->
                <!-- </div> -->
            </div>
        </div>
        <!-- partial:./partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                {{-- Pastikan ada pengguna yang sedang login --}}
                @auth

                    {{-- ============================================ --}}
                    {{-- MENU UNTUK ADMIN --}}
                    {{-- ============================================ --}}
                    @if (Auth::user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                <i class="mdi mdi-view-dashboard menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                                <div class="badge badge-info badge-pill">Admin</div>
                            </a>
                        </li>

                        {{-- Kategori Manajemen --}}
                        <li class="nav-item sidebar-category">
                            <p>Manajemen</p>
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

                        {{-- Kategori Stok Barang --}}
                        <li class="nav-item sidebar-category">
                            <p>Stok Barang</p>
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

                        {{-- Kategori Check Data --}}
                        <li class="nav-item sidebar-category">
                            <p>Check Data</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.produk.KadaluarsaProduk') }}">
                                <i class="mdi mdi-calendar-remove menu-icon"></i>
                                <span class="menu-title">Produk Kadaluarsa</span>
                            </a>
                        </li>

                        {{-- Kategori Pengguna --}}
                        <li class="nav-item sidebar-category">
                            <p>Pengguna</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}">
                                <i class="mdi mdi-account-multiple menu-icon"></i>
                                <span class="menu-title">Kelola Pengguna</span>
                            </a>
                        </li>

                        {{-- Kategori Laporan (Juga dapat diakses Manager)--}}
                        <li class="nav-item sidebar-category">
                            <p>Laporan</p>
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
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.laporan_barang_masuk') }}">Laporan Barang Masuk</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.laporan_barang_keluar') }}">Laporan Barang Keluar</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.laporan_antrian') }}">Laporan
                                            Antrian</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.produk.daftarproduk') }}">Laporan Stok</a></li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_barang_terlaris') }}">Laporan Barang
                                            Terlaku</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- ============================================ --}}
                        {{-- MENU UNTUK MANAGER --}}
                        {{-- ============================================ --}}
                    @elseif (Auth::user()->role === 'manager')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('manager.dashboard') }}"> {{-- Arahkan ke dashboard manager --}}
                                <i class="mdi mdi-view-dashboard menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                                <div class="badge badge-success badge-pill">Manager</div>
                            </a>
                        </li>

                        {{-- Kategori Laporan --}}
                        <li class="nav-item sidebar-category">
                            <p>Laporan</p>
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
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.laporan_barang_masuk') }}">Laporan Barang Masuk</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.laporan_barang_keluar') }}">Laporan Barang Keluar</a></li>
                                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.laporan_antrian') }}">Laporan
                                            Antrian</a></li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.produk.daftarproduk') }}">Laporan Stok</a></li>
                                </ul>
                            </div>
                        </li>

                        {{-- ============================================ --}}
                        {{-- MENU UNTUK PEGAWAI --}}
                        {{-- ============================================ --}}
                    @elseif (Auth::user()->role === 'pegawai')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pegawai.dashboard') }}"> {{-- Arahkan ke dashboard pegawai --}}
                                <i class="mdi mdi-view-dashboard menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                                <div class="badge badge-primary badge-pill">Pegawai</div>
                            </a>
                        </li>
                        <li class="nav-item sidebar-category">
                            <p>Manajemen</p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('daftarAntrian.index') }}">
                                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                                <span class="menu-title">Data Antrian</span>
                            </a>
                        </li>
                    @endif

                @endauth
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
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;">Laporan stok
                    </h4>
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
                            <h4 class="mb-0 font-weight-bold d-none d-xl-block" id="tanggal-sekarang-js">
                            </h4>
                        </li>

                        <script>
                            // Pastikan skrip ini dijalankan setelah elemen HTML dimuat
                            document.addEventListener('DOMContentLoaded', function () {
                                const elemenTanggal = document.getElementById('tanggal-sekarang-js');
                                const tanggalHariIni = new Date(); // Mendapatkan tanggal dan waktu saat ini

                                // Opsi untuk format tanggal (pilih salah satu atau sesuaikan)

                                // Pilihan 1: Format "02 Juni 2025"
                                const opsiFormat1 = {
                                    day: '2-digit', // 01, 02, ..., 31
                                    month: 'long',  // Januari, Februari, ..., Juni, ...
                                    year: 'numeric' // 2023, 2024, 2025
                                };

                                // Pilihan 2: Format "Senin, 02 Juni 2025"
                                const opsiFormat2 = {
                                    weekday: 'long', // Senin, Selasa, ...
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric'
                                };

                                // Pilih format yang ingin Anda gunakan:
                                const formatTerpilih = opsiFormat2; // Ganti ke opsiFormat1 jika ingin format yang lebih pendek

                                // Mengonversi tanggal ke string dengan format bahasa Indonesia
                                const tanggalFormatted = tanggalHariIni.toLocaleDateString('id-ID', formatTerpilih);

                                // Menampilkan tanggal yang sudah diformat ke dalam elemen h4
                                if (elemenTanggal) {
                                    elemenTanggal.textContent = tanggalFormatted;
                                }
                            });
                        </script>
                        <!-- <li class="nav-item dropdown me-1">
                            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
                                id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                <i class="mdi mdi-calendar mx-0"></i>
                                <span class="count bg-danger">1</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                                aria-labelledby="messageDropdown">
                                <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            The meeting is cancelled
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            New product launch
                                        </p>
                                    </div>
                                </a>
                                <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                                    </div>
                                    <div class="preview-item-content flex-grow">
                                        <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                        </h6>
                                        <p class="font-weight-light small-text text-muted mb-0">
                                            Upcoming board meeting
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </li> -->
                        <li class="nav-item dropdown me-2">
                            {{-- Form ini akan mengirimkan request POST ke route 'logout' --}}
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
                <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
                    <ul class="navbar-nav mr-lg-2">
                        <li class="nav-item nav-search d-none d-lg-block">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Here..." aria-label="search"
                                    aria-describedby="search">
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <!-- <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                <img src="images/faces/face5.jpg" alt="profile" />
                                <span class="nav-profile-name">Eleanor Richardson</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                                aria-labelledby="profileDropdown">
                                <a class="dropdown-item">
                                    <i class="mdi mdi-settings text-primary"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                            </div>
                        </li> -->
                        <li class="nav-item">
                            <a href="#" class="nav-link icon-link">
                                <i class="mdi mdi-plus-circle-outline"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link icon-link">
                                <i class="mdi mdi-web"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link icon-link">
                                <i class="mdi mdi-clock-outline"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="row"> {{-- Konten akan dimulai di dalam row ini --}}
                                    <div class="col-lg-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="card-title mb-0">Daftar Produk</h4>
                                                    <div>
                                                        {{-- Tombol untuk Unduh --}}
                                                        <button id="exportPdfBtn" class="btn btn-danger btn-sm">Unduh
                                                            PDF</button>
                                                        <button id="exportCsvBtn" class="btn btn-success btn-sm">Unduh
                                                            Excel (CSV)</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">

                                                {{-- Input Pencarian --}}
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="searchInput"
                                                        placeholder="Cari produk (ID, Nama, Kategori)...">
                                                </div>

                                                <div class="table-responsive mt-3">
                                                    <table class="table table-hover" id="produkTable">
                                                        <thead>
                                                            <tr>
                                                                <th>ID Produk</th>
                                                                <th>Nama Produk</th>
                                                                <th>Kategori</th>
                                                                <th>Total Stok</th>
                                                                <th>Detail Stok per Batch</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($produks as $produk)
                                                                <tr>
                                                                    <td>{{ $produk->id_produk }}</td>
                                                                    <td>{{ $produk->nama_produk }}</td>
                                                                    <td>{{ $produk->kategori }}</td>
                                                                    <td>
                                                                        {{-- Menggunakan atribut total_stok yang dihitung di
                                                                        controller dengan withSum --}}
                                                                        {{ $produk->total_stok ?? $produk->barangMasuks->sum('jumlah') }}
                                                                    </td>
                                                                    <td>
                                                                        @if($produk->barangMasuks->count() > 0)
                                                                            <ul class="list-unstyled mb-0">
                                                                                @foreach($produk->barangMasuks->where('jumlah', '>', 0)->sortBy('tanggal_masuk') as $batch)
                                                                                    <li>
                                                                                        <small>
                                                                                            {{-- Batch ({{ $batch->id_masuk }}):
                                                                                            --}}
                                                                                            {{ $batch->jumlah }} pcs
                                                                                            (Masuk:
                                                                                            {{ $batch->tanggal_masuk ? $batch->tanggal_masuk->format('d/m/y') : '-' }}
                                                                                            | Expired:
                                                                                            {{ $batch->tanggal_kedaluwarsa ? $batch->tanggal_kedaluwarsa->format('d/m/y') : '-' }})
                                                                                        </small>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <span class="text-muted text-small">Belum ada
                                                                                stok</span>
                                                                        @endif
                                                                    </td>

                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td colspan="6" class="text-center">Tidak ada data
                                                                        produk ditemukan.</td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="mt-3">
                                                    {{ $produks->links() }} {{-- Link pagination --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- akhir dari <div class="row"> yang ada di snippet awal Anda --}}
                                </div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const searchInput = document.getElementById('searchInput');
                                    const table = document.getElementById('produkTable');
                                    const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                                    searchInput.addEventListener('keyup', function (event) {
                                        const searchTerm = event.target.value.toLowerCase();

                                        for (let i = 0; i < tableRows.length; i++) {
                                            const row = tableRows[i];
                                            // Mengambil teks dari kolom ID Produk, Nama Produk, Kategori
                                            // Sesuaikan indeks kolom jika struktur tabel Anda berbeda
                                            const idProdukCell = row.getElementsByTagName('td')[0];
                                            const namaProdukCell = row.getElementsByTagName('td')[1];
                                            const kategoriCell = row.getElementsByTagName('td')[2];

                                            let rowText = '';
                                            if (idProdukCell) {
                                                rowText += idProdukCell.textContent || idProdukCell.innerText;
                                            }
                                            if (namaProdukCell) {
                                                rowText += ' ' + (namaProdukCell.textContent || namaProdukCell.innerText);
                                            }
                                            if (kategoriCell) {
                                                rowText += ' ' + (kategoriCell.textContent || kategoriCell.innerText);
                                            }

                                            rowText = rowText.toLowerCase();

                                            if (rowText.includes(searchTerm)) {
                                                row.style.display = ''; // Tampilkan baris
                                            } else {
                                                row.style.display = 'none'; // Sembunyikan baris
                                            }
                                        }
                                    });
                                });
                            </script>

                            {{-- CSS tambahan jika diperlukan --}}
                            <style>
                                .table th,
                                .table td {
                                    vertical-align: middle;
                                }

                                .card-header .d-flex {
                                    /* Untuk merapikan header card jika ada tombol tambah */
                                    width: 100%;
                                }

                                .text-small {
                                    font-size: 0.8rem;
                                }
                            </style>

                        </div>
                        <script>
                            // Fungsi untuk Ekspor ke CSV
                            function exportTableToCSV(filename) {
                                let csv = [];
                                const table = document.getElementById('produkTable');
                                const rows = table.querySelectorAll('tr');

                                // Mengambil header
                                const headerRow = rows[0];
                                let header = [];
                                headerRow.querySelectorAll('th').forEach(cell => {
                                    header.push('"' + cell.innerText.trim() + '"');
                                });
                                csv.push(header.join(','));

                                // Mengambil data baris
                                for (let i = 1; i < rows.length; i++) {
                                    const row = rows[i];
                                    // Hanya proses baris yang terlihat (tidak disembunyikan oleh filter)
                                    if (row.style.display !== 'none') {
                                        let rowData = [];
                                        row.querySelectorAll('td').forEach(cell => {
                                            // Membersihkan teks, terutama untuk kolom batch
                                            let text = cell.innerText.replace(/"/g, '""').replace(/\s\s+/g, ' ').trim();
                                            rowData.push('"' + text + '"');
                                        });
                                        csv.push(rowData.join(','));
                                    }
                                }

                                // Membuat link download
                                const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
                                const downloadLink = document.createElement('a');
                                downloadLink.download = filename;
                                downloadLink.href = window.URL.createObjectURL(csvFile);
                                downloadLink.style.display = 'none';
                                document.body.appendChild(downloadLink);
                                downloadLink.click();
                                document.body.removeChild(downloadLink);
                            }

                            // Fungsi untuk Cetak ke PDF
                            function printToPDF() {
                                // Simpan referensi ke semua elemen yang bisa disembunyikan
                                const elementsToHide = document.querySelectorAll('.sidebar, .navbar, .footer, #exportPdfBtn, #exportCsvBtn, #searchInput');

                                // Sembunyikan elemen-elemen tersebut sebelum mencetak
                                elementsToHide.forEach(el => el.style.setProperty('display', 'none', 'important'));

                                // Panggil fungsi cetak browser
                                window.print();
                            }


                            document.addEventListener('DOMContentLoaded', function () {
                                // --- LOGIKA PENCARIAN (SUDAH ADA) ---
                                const searchInput = document.getElementById('searchInput');
                                const table = document.getElementById('produkTable');
                                const tableRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');

                                searchInput.addEventListener('keyup', function (event) {
                                    const searchTerm = event.target.value.toLowerCase();

                                    for (let i = 0; i < tableRows.length; i++) {
                                        const row = tableRows[i];
                                        const idProdukCell = row.getElementsByTagName('td')[0];
                                        const namaProdukCell = row.getElementsByTagName('td')[1];
                                        const kategoriCell = row.getElementsByTagName('td')[2];

                                        let rowText = '';
                                        if (idProdukCell) rowText += idProdukCell.textContent || idProdukCell.innerText;
                                        if (namaProdukCell) rowText += ' ' + (namaProdukCell.textContent || namaProdukCell.innerText);
                                        if (kategoriCell) rowText += ' ' + (kategoriCell.textContent || kategoriCell.innerText);

                                        rowText = rowText.toLowerCase();

                                        if (rowText.includes(searchTerm)) {
                                            row.style.display = '';
                                        } else {
                                            row.style.display = 'none';
                                        }
                                    }
                                });

                                // --- EVENT LISTENER UNTUK TOMBOL BARU ---
                                const exportCsvBtn = document.getElementById('exportCsvBtn');
                                exportCsvBtn.addEventListener('click', function () {
                                    exportTableToCSV('daftar_produk.csv');
                                });

                                const exportPdfBtn = document.getElementById('exportPdfBtn');
                                exportPdfBtn.addEventListener('click', printToPDF);

                                // --- Mengembalikan Tampilan Setelah Mencetak ---
                                // 'afterprint' akan dijalankan setelah dialog cetak ditutup
                                window.onafterprint = function () {
                                    const elementsToRestore = document.querySelectorAll('.sidebar, .navbar, .footer, #exportPdfBtn, #exportCsvBtn, #searchInput');
                                    elementsToRestore.forEach(el => el.style.display = ''); // Kembalikan ke tampilan default
                                };
                            });
                        </script>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:./partials/_footer.html -->
                    <footer class="footer">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                                    <span
                                        class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright
                                        ©
                                        <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com
                                        </a>2021</span>
                                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the
                                        best
                                        <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard
                                        </a>
                                        templates</span>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- base:js -->
        <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
        <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('assets/js/template.js') }}"></script>
        <!-- endinject -->
        <!-- plugin js for this page -->
        <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
        <!-- End plugin js for this page -->
        <!-- Custom js for this page-->
        <script src="{{ asset('assets/js/dashboard.js') }}"></script>
        <!-- End custom js for this page-->
</body>

</html>