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
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;"> Laporan Antrian
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="h3 mb-2 text-gray-800">Laporan Antrian</h1>
                                <p class="mb-4">Daftar status produk yang masuk antrian (selesai atau dalam proses).</p>

                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            Data Antrian
                                            @if ($filterStatus == 'selesai')
                                                (Selesai)
                                            @elseif ($filterStatus == 'pending')
                                                (Dalam Antrian)
                                            @else
                                                (Semua)
                                            @endif
                                        </h6>
                                        <div class="d-flex align-items-center">
                                            {{-- Tombol Filter --}}
                                            <div class="btn-group mr-2" role="group" aria-label="Filter Antrian">
                                                <a href="{{ route('laporan.antrian', ['status' => null]) }}"
                                                    class="btn btn-sm {{ is_null($filterStatus) ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                                                <a href="{{ route('laporan.antrian', ['status' => 'selesai']) }}"
                                                    class="btn btn-sm {{ $filterStatus == 'selesai' ? 'btn-success' : 'btn-outline-success' }}">Selesai</a>
                                                <a href="{{ route('laporan.antrian', ['status' => 'pending']) }}"
                                                    class="btn btn-sm {{ $filterStatus == 'pending' ? 'btn-info' : 'btn-outline-info' }}">Dalam
                                                    Antrian</a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="antrianDataTable" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Tipe</th>
                                                        <th>Tanggal</th>
                                                        <th>Nama Produk</th>
                                                        <th>Jumlah</th>
                                                        <th>Action</th> {{-- <-- Tambah kolom Action --}} </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($laporanAntrianData as $index => $data)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>
                                                                @if($data['tipe'] == 'Selesai')
                                                                    <span class="badge badge-success">Selesai</span>
                                                                @else
                                                                    <span class="badge badge-info">Dalam Antrian</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($data['tanggal'])->format('d M Y H:i') }}
                                                            </td>
                                                            <td>{{ $data['nama_produk'] }}</td>
                                                            <td>{{ $data['jumlah'] }}</td>
                                                            <td>
                                                                <form
                                                                    action="{{ route('antrian.destroy', ['id' => $data['id'], 'tipe' => $data['tipe']]) }}"
                                                                    method="POST" class="d-inline delete-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                                        <i class="fas fa-trash"></i> Hapus
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="6" class="text-center">Tidak ada data antrian yang
                                                                ditemukan.</td> {{-- <-- Ubah colspan --}} </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                            {{-- Tombol Export Excel --}}
                                            <button id="exportExcelBtn" class="btn btn-sm btn-success mr-2 mt-2">Export
                                                Excel</button>

                                            {{-- Tombol Export PDF --}}
                                            <button id="exportPdfBtn" class="btn btn-sm btn-danger mt-2">Export
                                                PDF</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @push('scripts')
                    {{-- Sertakan library JavaScript --}}
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

                    <script>
                        const laporanAntrianData = @json($laporanAntrianData);
                        const filterStatus = @json($filterStatus);

                        document.addEventListener('DOMContentLoaded', function () {
                            const exportExcelBtn = document.getElementById('exportExcelBtn');
                            const exportPdfBtn = document.getElementById('exportPdfBtn');
                            const dataTable = document.getElementById('antrianDataTable');

                            // --- Handle Delete Form Submission with SweetAlert2 ---
                            document.querySelectorAll('.delete-form').forEach(form => {
                                form.addEventListener('submit', function (e) {
                                    e.preventDefault(); // Prevent the default form submission

                                    Swal.fire({
                                        title: 'Anda yakin?',
                                        text: "Data antrian ini akan dihapus permanen!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        cancelButtonColor: '#3085d6',
                                        confirmButtonText: 'Ya, hapus!',
                                        cancelButtonText: 'Batal'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            this.submit(); // Submit the form if confirmed
                                        }
                                    });
                                });
                            });

                            // --- Fungsi Export ke Excel ---
                            exportExcelBtn.addEventListener('click', function () {
                                const dataToExport = laporanAntrianData.map(item => ({
                                    'Tipe': item.tipe,
                                    'Tanggal': new Date(item.tanggal).toLocaleString('id-ID', {
                                        day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'
                                    }),
                                    'Nama Produk': item.nama_produk,
                                    'Jumlah': item.jumlah
                                }));

                                const ws = XLSX.utils.json_to_sheet(dataToExport);
                                const wb = XLSX.utils.book_new();
                                XLSX.utils.book_append_sheet(wb, ws, "Laporan Antrian");

                                let fileName = 'laporan_antrian';
                                if (filterStatus) {
                                    fileName += `_${filterStatus}`;
                                }
                                fileName += `_${new Date().toISOString().slice(0, 10).replace(/-/g, "")}_${new Date().toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/:/g, '')}.xlsx`;

                                XLSX.writeFile(wb, fileName);
                            });

                            // --- Fungsi Export ke PDF ---
                            exportPdfBtn.addEventListener('click', function () {
                                let title = 'Laporan Antrian';
                                if (filterStatus === 'selesai') {
                                    title += ' (Selesai)';
                                } else if (filterStatus === 'pending') {
                                    title += ' (Dalam Antrian)';
                                } else {
                                    title += ' (Semua)';
                                }

                                const cardBody = dataTable.closest('.card-body');

                                html2canvas(cardBody, {
                                    scale: 2
                                }).then(canvas => {
                                    const imgData = canvas.toDataURL('image/png');
                                    const { jsPDF } = window.jspdf;
                                    const pdf = new jsPDF('p', 'mm', 'a4');
                                    const imgWidth = 200;
                                    const pageHeight = pdf.internal.pageSize.height;
                                    const imgHeight = canvas.height * imgWidth / canvas.width;
                                    let heightLeft = imgHeight;
                                    let position = 10;

                                    pdf.setFontSize(18);
                                    pdf.text(title, pdf.internal.pageSize.width / 2, 15, { align: 'center' });
                                    pdf.setFontSize(10);
                                    pdf.text(`Dicetak pada: ${new Date().toLocaleString('id-ID')}`, pdf.internal.pageSize.width / 2, 25, { align: 'center' });

                                    position = 35;

                                    pdf.addImage(imgData, 'PNG', 5, position, imgWidth, imgHeight);
                                    heightLeft -= pageHeight;

                                    while (heightLeft >= 0) {
                                        position = heightLeft - imgHeight + (pageHeight - 5);
                                        pdf.addPage();
                                        pdf.addImage(imgData, 'PNG', 5, position, imgWidth, imgHeight);
                                        heightLeft -= pageHeight;
                                    }

                                    let fileName = 'laporan_antrian';
                                    if (filterStatus) {
                                        fileName += `_${filterStatus}`;
                                    }
                                    fileName += `_${new Date().toISOString().slice(0, 10).replace(/-/g, "")}_${new Date().toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/:/g, '')}.pdf`;

                                    pdf.save(fileName);
                                });
                            });
                        });
                    </script>
                @endpush
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