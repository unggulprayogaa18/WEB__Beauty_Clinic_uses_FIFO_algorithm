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
                        <li class="nav-item active">
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
                                </ul>
                            </div>
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
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;"> Laporan Barang
                        Keluar</h4>
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
                        <div class="col-12">
                            {{-- Tabel Data Barang Keluar --}}
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Data Barang Keluar</h3>
                                    <div class="card-tools">
                                        {{-- Tombol Export Barang Keluar --}}
                                        <button id="exportPdfBarangKeluarBtn" class="btn btn-danger btn-sm">
                                            <i class="fas fa-file-pdf"></i> Export to PDF
                                        </button>
                                        <button id="exportExcelBarangKeluarBtn" class="btn btn-success btn-sm">
                                            <i class="fas fa-file-excel"></i> Export to Excel
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="barangKeluarTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ID Keluar</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Tanggal Keluar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barangKeluars as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->id_keluar }}</td>
                                                    <td>{{ $item->produk->nama_produk }}</td>
                                                    <td>{{ $item->produk->kategori }}</td>
                                                    <td>{{ $item->jumlah }}</td>
                                                    <td>{{ $item->tanggal_keluar->format('d-m-Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-center">
                                        {{ $barangKeluars->links() }} {{-- Paginasi untuk Barang Keluar --}}
                                    </div>
                                </div>
                            </div>
                            <br> {{-- Sedikit spasi antar kartu --}}

                       
                        </div>
                    </div>

                    @push('scripts')
                        {{-- Pastikan Anda sudah memuat library JS PDF dan Excel di layout utama atau di sini --}}
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                        <script
                            src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js"></script>
                        <script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                // --- Export Barang Keluar ---
                                const tableKeluar = document.getElementById('barangKeluarTable');
                                const exportPdfKeluarBtn = document.getElementById('exportPdfBarangKeluarBtn');
                                const exportExcelKeluarBtn = document.getElementById('exportExcelBarangKeluarBtn');

                                if (exportPdfKeluarBtn) {
                                    exportPdfKeluarBtn.addEventListener('click', function () {
                                        const { jsPDF } = window.jspdf;
                                        const doc = new jsPDF('p', 'pt', 'a4');
                                        const headers = Array.from(tableKeluar.querySelectorAll('thead th')).map(th => th.innerText);
                                        const data = Array.from(tableKeluar.querySelectorAll('tbody tr')).map(row => {
                                            return Array.from(row.querySelectorAll('td')).map(td => td.innerText);
                                        });
                                        doc.autoTable({
                                            head: [headers],
                                            body: data,
                                            startY: 60,
                                            theme: 'striped',
                                            headStyles: { fillColor: [220, 53, 69] },
                                            didDrawPage: function (data) {
                                                doc.setFontSize(16);
                                                doc.text('Laporan Barang Keluar', data.settings.margin.left, 40);
                                                doc.setFontSize(10);
                                                doc.text('Page ' + data.pageNumber, doc.internal.pageSize.width - data.settings.margin.right, doc.internal.pageSize.height - 30);
                                            }
                                        });
                                        doc.save('Laporan_Barang_Keluar.pdf');
                                    });
                                }

                                if (exportExcelKeluarBtn) {
                                    exportExcelKeluarBtn.addEventListener('click', function () {
                                        const wb = XLSX.utils.table_to_book(tableKeluar, { sheet: "Barang Keluar" });
                                        XLSX.writeFile(wb, "Laporan_Barang_Keluar.xlsx");
                                    });
                                }

                                // --- Export Daftar Antrian ---
                                const tableAntrian = document.getElementById('daftarAntrianTable');
                                const exportPdfDaftarAntrianBtn = document.getElementById('exportPdfDaftarAntrianBtn');
                                const exportExcelDaftarAntrianBtn = document.getElementById('exportExcelDaftarAntrianBtn');

                                if (exportPdfDaftarAntrianBtn) {
                                    exportPdfDaftarAntrianBtn.addEventListener('click', function () {
                                        const { jsPDF } = window.jspdf;
                                        const doc = new jsPDF('l', 'pt', 'a4'); // 'l' for landscape might be better for more columns
                                        const headers = Array.from(tableAntrian.querySelectorAll('thead th')).map(th => th.innerText);
                                        const data = Array.from(tableAntrian.querySelectorAll('tbody tr')).map(row => {
                                            return Array.from(row.querySelectorAll('td')).map(td => td.innerText);
                                        });
                                        doc.autoTable({
                                            head: [headers],
                                            body: data,
                                            startY: 60,
                                            theme: 'striped',
                                            headStyles: { fillColor: [40, 167, 69] },
                                            didDrawPage: function (data) {
                                                doc.setFontSize(16);
                                                doc.text('Laporan Daftar Antrian', data.settings.margin.left, 40);
                                                doc.setFontSize(10);
                                                doc.text('Page ' + data.pageNumber, doc.internal.pageSize.width - data.settings.margin.right, doc.internal.pageSize.height - 30);
                                            }
                                        });
                                        doc.save('Laporan_Daftar_Antrian.pdf');
                                    });
                                }

                                if (exportExcelDaftarAntrianBtn) {
                                    exportExcelDaftarAntrianBtn.addEventListener('click', function () {
                                        const wb = XLSX.utils.table_to_book(tableAntrian, { sheet: "Daftar Antrian" });
                                        XLSX.writeFile(wb, "Laporan_Daftar_Antrian.xlsx");
                                    });
                                }
                            });
                        </script>
                    @endpush
                </div>

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:./partials/_footer.html -->
        
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