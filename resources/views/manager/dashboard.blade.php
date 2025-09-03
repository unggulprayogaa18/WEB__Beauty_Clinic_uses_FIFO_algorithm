<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Spica Manajer</title>
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
                <li class="nav-item sidebar-category">
                    <span></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                        <div class="badge badge-info badge-pill">Manajer</div>
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
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;"> DASHBOARD</h4>
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
                    <style>
                        /* Contoh styling sederhana untuk card jika tidak menggunakan framework CSS lengkap */
                        .card {
                            border: 1px solid #e0e0e0;
                            border-radius: 8px;
                            margin-bottom: 1.5rem;
                            color: white;
                            /* Default teks putih untuk card dengan background berwarna */
                        }

                        .card-body {
                            padding: 1.25rem;
                            /* Default padding Bootstrap */
                        }

                        .py-5 {
                            /* Bootstrap class */
                            padding-top: 3rem !important;
                            padding-bottom: 3rem !important;
                        }

                        .d-flex {
                            display: flex !important;
                        }

                        .align-items-center {
                            align-items: center !important;
                        }

                        .flex-wrap {
                            flex-wrap: wrap !important;
                        }

                        .justify-content-md-center {
                            justify-content: center !important;
                        }

                        .justify-content-xl-start {
                            justify-content: flex-start !important;
                        }

                        /* Default untuk XL dan lebih besar */

                        .ms-3 {
                            margin-left: 1rem !important;
                        }

                        /* Bootstrap class */
                        .ml-md-0 {
                            margin-left: 0 !important;
                        }

                        /* Default untuk MD */
                        .ml-xl-3 {
                            margin-left: 1rem !important;
                        }

                        /* Default untuk XL */

                        .icon-lg {
                            font-size: 2.5rem;
                            /* Ukuran ikon besar */
                        }

                        .text-white {
                            color: #fff !important;
                        }

                        .font-weight-bold {
                            font-weight: 700 !important;
                        }

                        .mt-2 {
                            margin-top: 0.5rem !important;
                        }

                        .card-text {
                            font-size: 0.9rem;
                        }



                        /* Warna contoh untuk Twitter */

                        /* Penyesuaian warna card agar lebih sesuai dengan konten baru */
                        .bg-pending {
                            background-color: #ffc107;
                            color: #212529 !important;
                        }

                        /* Kuning untuk pending, teks gelap */
                        .bg-pending .text-white {
                            color: #212529 !important;
                        }

                        /* Override text-white jika ada */

                        .bg-completed {
                            background-color: #28a745;
                        }

                        /* Hijau untuk selesai */
                        .bg-expiring {
                            background-color: #dc3545;
                        }

                        /* Merah untuk kadaluarsa/warning */

                        /* Untuk layout row dan col jika tidak menggunakan Bootstrap grid */
                        .row {
                            display: flex;
                            flex-wrap: wrap;
                            margin-right: -15px;
                            margin-left: -15px;
                        }

                        .col-md-4 {
                            position: relative;
                            width: 100%;
                            padding-right: 15px;
                            padding-left: 15px;
                        }

                        @media (min-width: 768px) {

                            /* md breakpoint */
                            .col-md-4 {
                                flex: 0 0 33.333333%;
                                max-width: 33.333333%;
                            }

                            .justify-content-md-center {
                                justify-content: center !important;
                            }

                            .ml-md-0 {
                                margin-left: 0 !important;
                            }
                        }

                        @media (min-width: 1200px) {

                            /* xl breakpoint */
                            .justify-content-xl-start {
                                justify-content: flex-start !important;
                            }

                            .ml-xl-3 {
                                margin-left: 1rem !important;
                            }
                        }
                    </style>
                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            {{-- Mengganti bg-facebook dengan warna yang lebih sesuai untuk pending --}}
                            <div class="card bg-facebook d-flex align-items-center">
                                <div class="card-body py-5">
                                    <div
                                        class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                        {{-- Icon disesuaikan untuk antrian pending --}}
                                        <i class="mdi mdi-timer-sand text-white icon-lg"></i>
                                        <div class="ms-3 ml-md-0 ml-xl-3">
                                            <h5 class="text-white font-weight-bold">Antrian Pending Hari ini</h5>
                                            <p class="mt-2 text-white card-text">{{ $jumlahAntrianPending }} Orang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            {{-- Mengganti bg-google dengan warna yang lebih sesuai untuk selesai --}}
                            <div class="card bg-facebook d-flex align-items-center">
                                <div class="card-body py-5">
                                    <div
                                        class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                        {{-- Icon disesuaikan untuk antrian selesai --}}
                                        <i class="mdi mdi-check-circle-outline text-white icon-lg"></i>
                                        <div class="ms-3 ml-md-0 ml-xl-3">
                                            <h5 class="text-white font-weight-bold">Antrian Selesai Hari ini</h5>
                                            <p class="mt-2 text-white card-text">{{ $jumlahAntrianSelesaiHariIni }}
                                                Orang</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            {{-- Mengganti bg-twitter dengan warna yang lebih sesuai untuk produk kadaluarsa --}}
                            <div class="card bg-facebook d-flex align-items-center">
                                <div class="card-body py-5">
                                    <div
                                        class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                                        {{-- Icon disesuaikan untuk produk kadaluarsa --}}
                                        <i class="mdi mdi-calendar-alert text-white icon-lg"></i>
                                        <div class="ms-3 ml-md-0 ml-xl-3">
                                            <h5 class="text-white font-weight-bold">Produk Kadaluarsa Bulan Ini</h5>
                                            <p class="mt-2 text-white card-text">
                                                {{ $jumlahProdukKadaluarsaBulanIni }} produk
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                    {{-- <div class="row">
                        <div class="col-12 col-xl-6 grid-margin stretch-card">
                            <div class="row w-100 flex-grow">


                                <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-title">Grafik Data</p>
                                            <p class="text-muted">Barang masuk dan Barang keluar</p>
                                            <div class="row mb-3">
                                                <div class="col-md-7">
                                                    <div class="d-flex justify-content-between traffic-status">
                                                        <div class="item">
                                                            <p class="mb-">Barang Masuk</p>
                                                            <h5 class="font-weight-bold mb-0">
                                                            </h5>
                                                            <div class="color-border"></div>
                                                        </div>
                                                        <div class="item">
                                                            <p class="mb-">Barang Keluar</p>
                                                            <h5 class="font-weight-bold mb-0">
                                                            </h5>
                                                            <div class="color-border"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <ul class="nav nav-pills nav-pills-custom justify-content-md-end"
                                                        id="pills-tab-custom" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="pills-home-tab-custom"
                                                                data-toggle="pill" href="#pills-health" role="tab"
                                                                aria-controls="pills-home" aria-selected="true">
                                                                Mingguan
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-profile-tab-custom"
                                                                data-toggle="pill" href="#pills-career" role="tab"
                                                                aria-controls="pills-profile" aria-selected="false">
                                                                Bulanan
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="pills-contact-tab-custom"
                                                                data-toggle="pill" href="#pills-music" role="tab"
                                                                aria-controls="pills-contact" aria-selected="false">
                                                                Tahunan
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <canvas id="Grafik barang masuk dan keluar"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <p class="card-title">Weekly Balance</p>
                                                <p class="text-success font-weight-medium">20.15 %</p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mb-3">
                                                <h5 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3">$22.736</h5>
                                                <p class="text-muted mb-0">Avg Sessions</p>
                                            </div>
                                            <canvas id="balance-chart" height="130"></canvas>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                                <p class="card-title">Today Task</p>
                                                <p class="text-success font-weight-medium">45.39 %</p>
                                            </div>
                                            <div class="d-flex align-items-center flex-wrap mb-3">
                                                <h5 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 me-3">17.247</h5>
                                                <p class="text-muted mb-0">Avg Sessions</p>
                                            </div>
                                            <canvas id="task-chart" height="130"></canvas>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <div class="col-12 col-xl-6 grid-margin stretch-card">
                            <div class="row w-100 flex-grow">
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="card-title">Regional Load</p>
                                            <p class="text-muted">Last update: 2 Hours ago</p>
                                            <div class="regional-chart-legend d-flex align-items-center flex-wrap mb-1"
                                                id="regional-chart-legend"></div>
                                            <canvas height="280" id="regional-chart"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 grid-margin stretch-card">
                                    <div class="card">
                                        <div class="card-body pb-0">
                                            <div class="d-flex align-items-center mb-4">
                                                <p class="card-title mb-0 me-1">Today activity</p>
                                                <div class="badge badge-info badge-pill">2</div>
                                            </div>
                                            <div class="d-flex flex-wrap pt-2">
                                                <div class="me-4 mb-lg-2 mb-xl-0">
                                                    <p>Time On Site</p>
                                                    <h4 class="font-weight-bold mb-0">77.15 %</h4>
                                                </div>
                                                <div>
                                                    <p>Page Views</p>
                                                    <h4 class="font-weight-bold mb-0">14.15 %</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <canvas height="150" id="activity-chart"></canvas>
                                    </div>
                                </div>
                                <div class="col-md-12 stretch-card">
                                    <div class="card">
                                        <div class="card-body pb-0">
                                            <p class="card-title">Server Status 247</p>
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <p class="text-muted">Last update: 2 Hours ago</p>
                                                <div
                                                    class="d-flex align-items-center flex-wrap server-status-legend mt-3 mb-3 mb-md-0">
                                                    <div class="item me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="color-bullet"></div>
                                                            <h5 class="font-weight-bold mb-0">128GB</h5>
                                                        </div>
                                                        <p class="mb-">Total Usage</p>
                                                    </div>
                                                    <div class="item me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="color-bullet"></div>
                                                            <h5 class="font-weight-bold mb-0">92%</h5>
                                                        </div>
                                                        <p class="mb-">Memory Usage</p>
                                                    </div>
                                                    <div class="item me-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="color-bullet"></div>
                                                            <h5 class="font-weight-bold mb-0">16%</h5>
                                                        </div>
                                                        <p class="mb-">Disk Usage</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <canvas height="170" id="status-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Financial management review</h4>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        User
                                                    </th>
                                                    <th>
                                                        First name
                                                    </th>
                                                    <th>
                                                        Progress
                                                    </th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Deadline
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="{{ asset('assets/images/faces/face1.jpg') }}"
                                                            alt="image" />
                                                    </td>
                                                    <td>
                                                        Herman Beck
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 77.99
                                                    </td>
                                                    <td>
                                                        May 15, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="{{ asset('assets/images/faces/face2.jpg"
                                                            alt="image') }}" />
                                                    </td>
                                                    <td>
                                                        Messsy Adam
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $245.30
                                                    </td>
                                                    <td>
                                                        July 1, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="{{ asset('assets/images/faces/face3.jpg') }}"
                                                            alt="image" />
                                                    </td>
                                                    <td>
                                                        John Richards
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $138.00
                                                    </td>
                                                    <td>
                                                        Apr 12, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="images/faces/face4.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Peter Meggik
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 77.99
                                                    </td>
                                                    <td>
                                                        May 15, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="images/faces/face5.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Edward
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 160.25
                                                    </td>
                                                    <td>
                                                        May 03, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="images/faces/face6.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        John Doe
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 123.21
                                                    </td>
                                                    <td>
                                                        April 05, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="images/faces/face7.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Henry Tom
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 150.00
                                                    </td>
                                                    <td>
                                                        June 16, 2015
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:./partials/_footer.html -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between py-2">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ©
                                    <a href="https://www.bootstrapdash.com/" target="_blank">bootstrapdash.com
                                    </a>2021</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Only the best
                                    <a href="https://www.bootstrapdash.com/" target="_blank"> Bootstrap dashboard </a>
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