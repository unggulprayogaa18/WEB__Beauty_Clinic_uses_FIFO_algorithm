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

    <!-- ==================================================
     == KODE CSS KUSTOM UNTUK FORM & TABEL PRODUK ==
     ================================================== -->
    <style>
        /* Warna utama */
        :root {
            --primary-maroon: #670D2F;
            --light-gray-bg: #f9f9f9;
            --border-color: #e0e0e0;
            --btn-hover-maroon: #500a25;
        }

        /* === Gaya untuk Form Tambah/Edit Produk === */
        .card-form-custom {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-form-custom .card-header {
    
            padding: 1rem 1.5rem;
            border-bottom: none;
        }

        .card-form-custom .card-header h5 {
                    color: #670D2F;
            font-weight: 600;
        }

        .card-form-custom .card-body {
            padding: 1.5rem;
        }

        /* Kustomisasi tombol utama pada form */
        .card-form-custom .btn-primary {
            background-color: var(--primary-maroon);
            border-color: var(--primary-maroon);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
        }

        .card-form-custom .btn-primary:hover {
            background-color: var(--btn-hover-maroon);
            border-color: var(--btn-hover-maroon);
        }

        .card-form-custom .form-control:focus {
            border-color: var(--primary-maroon);
            box-shadow: 0 0 0 0.2rem rgba(103, 13, 47, 0.25);
        }

        /* === Gaya untuk Tabel Daftar Produk === */
        .card-table-custom {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-table-custom .card-header {
            background-color: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-table-custom .card-header h5 {
            color: var(--primary-maroon);
            /* Judul tabel menjadi marun */
            font-weight: 600;
        }

        /* Menambahkan class kustom ke tabel */
        .table.table-custom {
            border: none;
        }

        /* Gaya untuk header tabel (thead) */
        .table-custom thead tr {
            background-color: var(--primary-maroon);
            color: white;
        }

        .table-custom thead th {
            padding: 1rem;
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border: none;
        }

        /* Gaya untuk body tabel (tbody) */
        .table-custom tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #333;
            border-top: 1px solid var(--border-color);
            /* Garis pemisah antar baris */
        }

        .table-custom tbody tr {
            background-color: white;
            /* Warna dasar baris */
            transition: background-color 0.2s ease-in-out;
        }

        /* Efek hover pada baris tabel */
        .table-custom tbody tr:hover {
            background-color: var(--light-gray-bg);
        }

        /* Menghapus border atas pada baris pertama di tbody */
        .table-custom tbody tr:first-child td {
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="container-scroller d-flex">
        <div class="row p-0 m-0 proBanner" id="proBanner">

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

                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;">INPUT DATA
                        PRODUK </h4>
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
                                const opsiFormat2 = {
                                    weekday: 'long', // Senin, Selasa, ...
                                    day: '2-digit',
                                    month: 'long',
                                    year: 'numeric'
                                };
                                const formatTerpilih = opsiFormat2;
                                const tanggalFormatted = tanggalHariIni.toLocaleDateString('id-ID', formatTerpilih);
                                if (elemenTanggal) {
                                    elemenTanggal.textContent = tanggalFormatted;
                                }
                            });
                        </script>
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
                    {{-- ===== NOTIFIKASI ===== --}}
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            {{-- Card wrapper dengan class kustom --}}
                            <div class="card card-form-custom">
                                <div class="card-header">
                                    <h5 id="form-title">Tambah Produk</h5>
                                </div>
                                <div class="card-body">
                                    <form id="form-produk" method="POST" action="{{ route('produk.store') }}">
                                        @csrf
                                        {{-- Akan diubah ke PUT saat edit --}}
                                        <input type="hidden" name="_method" id="form-_method" value="POST" disabled>
                                        <input type="hidden" name="id_produk" id="id_produk" value="">

                                        <div class="mb-3">
                                            <label for="nama_produk_input" class="form-label">Nama Produk</label>
                                            <input type="text" name="nama_produk" id="nama_produk_input"
                                                class="form-control @error('nama_produk') is-invalid @enderror"
                                                value="{{ old('nama_produk') }}" placeholder="Masukkan nama produk"
                                                required>
                                            @error('nama_produk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="kategori_input" class="form-label">Kategori</label>
                                            <input type="text" name="kategori" id="kategori_input"
                                                class="form-control @error('kategori') is-invalid @enderror"
                                                value="{{ old('kategori') }}" placeholder="Masukkan kategori" required>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <button type="submit" id="form-submit-btn" class="btn btn-primary">
                                            Simpan
                                        </button>
                                        <button type="button" id="form-cancel-btn" class="btn btn-secondary d-none">
                                            Batal
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End: row form --}}

                    <div class="row mt-4">
                        <div class="col-md-12">
                            {{-- Card tabel dengan class kustom --}}
                            <div class="card card-table-custom">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Daftar Produk</h5>
                                    <div class="d-flex align-items-center">
                                        <div class="input-group me-3" style="max-width: 300px;">
                                            <input type="text" id="searchInput" class="form-control"
                                                placeholder="Cari produk..." aria-label="Cari produk">
                                            <button class="btn btn-light" type="button" id="clearSearch">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body table-responsive">
                                    {{-- Tabel dengan class kustom --}}
                                    <table class="table table-custom" id="productTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($produks as $key => $produk)
                                                <tr data-id="{{ $produk->id_produk }}">
                                                    <td>{{ $produks->firstItem() + $key }}</td>
                                                    <td>{{ $produk->id_produk }}</td>
                                                    <td>{{ $produk->nama_produk }}</td>
                                                    <td>{{ $produk->kategori }}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning btn-edit"
                                                            data-id="{{ $produk->id_produk }}"
                                                            data-nama="{{ $produk->nama_produk }}"
                                                            data-kategori="{{ $produk->kategori }}"
                                                            data-update-url="{{ route('produk.update', $produk->id_produk) }}">
                                                            Edit
                                                        </button>
                                                        <form action="{{ route('produk.destroy', $produk->id_produk) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr id="noDataRow">
                                                    <td colspan="5" class="text-center">Belum ada data produk.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="d-flex justify-content-center mt-3" id="paginationLinks">
                                        {{ $produks->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End: row tabel --}}
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
                    <script
                        src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
                    <script
                        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

                    {{-- Skrip JavaScript Anda tetap di sini, tidak perlu diubah --}}
                    <script>
                        $(document).ready(function () {
                            // Simpan state default
                            var defaultAction = $('#form-produk').attr('action');
                            var defaultTitle = $('#form-title').text();
                            var defaultSubmit = $('#form-submit-btn').text();

                            // Fungsi reset ke mode Create (POST)
                            function resetForm() {
                                $('#form-produk').attr('action', defaultAction);
                                $('#form-_method').val('POST').prop('disabled', true);

                                $('#id_produk').val('');
                                $('#nama_produk_input').val('').removeClass('is-invalid');
                                $('#kategori_input').val('').removeClass('is-invalid');
                                $('.invalid-feedback').remove();

                                $('#form-title').text('Tambah Produk');
                                $('#form-submit-btn')
                                    .text('Simpan')
                                    .removeClass('btn-warning')
                                    .addClass('btn-primary');
                                $('#form-cancel-btn').addClass('d-none');
                            }

                            // Klik “Batal”
                            $('#form-cancel-btn').on('click', function () {
                                resetForm();
                            });

                            // Klik tombol Edit (delegasi)
                            $(document).on('click', '.btn-edit', function (e) {
                                e.preventDefault();
                                var id = $(this).data('id');
                                var nama = $(this).data('nama');
                                var kategori = $(this).data('kategori');
                                var updateUrl = $(this).data('update-url');

                                // Isi form dengan data
                                $('#nama_produk_input').val(nama);
                                $('#kategori_input').val(kategori);
                                $('#id_produk').val(id);

                                // Ubah form ke mode PUT
                                $('#form-produk').attr('action', updateUrl);
                                $('#form-_method').val('PUT').prop('disabled', false);

                                // Ubah judul & tombol ke mode edit
                                $('#form-title').text('Edit Produk (ID: ' + id + ')');
                                $('#form-submit-btn')
                                    .text('Update')
                                    .removeClass('btn-primary')
                                    .addClass('btn-warning');
                                $('#form-cancel-btn').removeClass('d-none');

                                $('#nama_produk_input').focus();
                            });


                            // Reset ke mode Create saat pertama load
                            resetForm();

                            // Client-side Search
                            const searchInput = $('#searchInput');
                            const productTableBody = $('#productTable tbody');
                            const paginationLinks = $('#paginationLinks');
                            let noDataRowOriginal = $('#noDataRow');
                            let originalRows = productTableBody.find('tr').toArray()
                                .filter(row => row.id !== 'noDataRow');

                            searchInput.on('keyup', function () {
                                const searchTerm = $(this).val().toLowerCase();
                                let visibleRowCount = 0;
                                productTableBody.empty();

                                originalRows.forEach(function (row) {
                                    const $row = $(row);
                                    const idProduk = $row.children().eq(1).text().toLowerCase();
                                    const namaProduk = $row.children().eq(2).text().toLowerCase();
                                    const kategori = $row.children().eq(3).text().toLowerCase();
                                    if (idProduk.includes(searchTerm) || namaProduk.includes(searchTerm) || kategori.includes(searchTerm)) {
                                        productTableBody.append($row.clone());
                                        visibleRowCount++;
                                    }
                                });

                                productTableBody.find('tr').each(function (index) {
                                    $(this).children().eq(0).text(index + 1);
                                });

                                if (visibleRowCount === 0) {
                                    let noRow = noDataRowOriginal.clone();
                                    noRow.find('td').attr('colspan', 5).text('Tidak ada produk yang cocok dengan pencarian Anda.');
                                    productTableBody.append(noRow);
                                    paginationLinks.hide();
                                } else {
                                    paginationLinks.toggle(searchTerm.length === 0);
                                }
                            });

                            $('#clearSearch').on('click', function () {
                                searchInput.val('').trigger('keyup');
                                paginationLinks.show();
                            });
                        });
                    </script>
                    @if(old('_method') === 'PUT' && session('error_form_type') === 'update' && request()->query('edit_failed_id'))
                        <script>
                            $(document).ready(function () {
                                var failedId = "{{ request()->query('edit_failed_id') }}";
                                $('#nama_produk_input').val("{{ old('nama_produk') }}");
                                $('#kategori_input').val("{{ old('kategori') }}");
                                $('#id_produk').val(failedId);
                                $('#form-produk').attr('action', "{{ url('produk') }}/" + failedId);
                                $('#form-_method').val('PUT').prop('disabled', false);
                                $('#form-title').text('Edit Produk (ID: ' + failedId + ')');
                                $('#form-submit-btn').text('Update').removeClass('btn-primary').addClass('btn-warning');
                                $('#form-cancel-btn').removeClass('d-none');
                                var errorsNama = {!!json_encode($errors->get('nama_produk')) !!};
                                var errorsKategori = {!!json_encode($errors->get('kategori')) !!};
                                if (Array.isArray(errorsNama)) {
                                    errorsNama.forEach(function (msg) {
                                        $('#nama_produk_input').addClass('is-invalid').after('<div class="invalid-feedback">' + msg + '</div>');
                                    });
                                }
                                if (Array.isArray(errorsKategori)) {
                                    errorsKategori.forEach(function (msg) {
                                        $('#kategori_input').addClass('is-invalid').after('<div class="invalid-feedback">' + msg + '</div>');
                                    });
                                }
                            });
                        </script>
                    @endif

                </div>
                {{-- End: content-wrapper --}}

            </div>
            {{-- End: main-panel --}}
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