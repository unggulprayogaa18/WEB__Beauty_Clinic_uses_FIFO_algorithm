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
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    <!-- ==================================================
     == KODE CSS KUSTOM UNTUK FORM & TABEL ==
     ================================================== -->
    <style>
        /* Warna utama */
        :root {
            --primary-maroon: #670D2F;
            --light-gray-bg: #f9f9f9;
            --border-color: #e0e0e0;
            --btn-hover-maroon: #500a25;
        }

        /* === Gaya untuk Form === */
        .card-form-custom {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .card-form-custom .card-header {
            color: white;
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

        .card-form-custom .form-control:focus,
        .card-form-custom .form-select:focus {
            border-color: var(--primary-maroon);
            box-shadow: 0 0 0 0.2rem rgba(103, 13, 47, 0.25);
        }

        /* === Gaya untuk Tabel === */
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
            font-weight: 600;
        }

        .table.table-custom {
            border: none;
        }

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

        .table-custom tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #333;
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
    </style>
</head>

<body>
    <div class="container-scroller d-flex">
        <!-- Sidebar -->
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
                            <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.laporan_barang_terlaris') }}">Laporan Barang
                                            Terlaku</a>
                                    </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <div class="container-fluid page-body-wrapper">
            <!-- Navbar -->
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;"> INPUT BARANG
                        MASUK</h4>
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
                <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
                    <ul class="navbar-nav mr-lg-2">
                        <li class="nav-item nav-search d-none d-lg-block">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Here..."
                                    aria-label="search" aria-describedby="search">
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item"><a href="#" class="nav-link icon-link"><i
                                    class="mdi mdi-plus-circle-outline"></i></a></li>
                        <li class="nav-item"><a href="#" class="nav-link icon-link"><i class="mdi mdi-web"></i></a>
                        </li>
                        <li class="nav-item"><a href="#" class="nav-link icon-link"><i
                                    class="mdi mdi-clock-outline"></i></a></li>
                    </ul>
                </div>
            </nav>

            <!-- Page content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid mt-0">
                        {{-- Notifikasi --}}
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        {{-- Form Create/Edit --}}
                        <div class="card card-form-custom mb-4">
                            <div class="card-header">
                                <h5 id="form-title">Tambah Barang Masuk</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-barang-masuk" method="POST"
                                    action="{{ route('admin.barang.masuk.store') }}">
                                    @csrf
                                    <input type="hidden" name="_method" id="form-_method" value="POST">
                                    <div class="mb-3">
                                        <label for="id_produk" class="form-label">Produk</label>
                                        <select name="id_produk" id="id_produk"
                                            class="form-select @error('id_produk') is-invalid @enderror">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($produks as $produk)
                                            <option value="{{ $produk->id_produk }}"
                                                {{ old('id_produk') == $produk->id_produk ? 'selected' : '' }}>
                                                {{ $produk->nama_produk }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah"
                                            class="form-control @error('jumlah') is-invalid @enderror" min="1"
                                            value="{{ old('jumlah') }}">
                                        @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                        <input type="date" name="tanggal_masuk" id="tanggal_masuk"
                                            class="form-control @error('tanggal_masuk') is-invalid @enderror"
                                            value="{{ old('tanggal_masuk', now()->format('Y-m-d')) }}" readonly>
                                        @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_kedaluwarsa" class="form-label">Tanggal
                                            Kedaluwarsa</label>
                                        <input type="date" name="tanggal_kedaluwarsa" id="tanggal_kedaluwarsa"
                                            class="form-control @error('tanggal_kedaluwarsa') is-invalid @enderror"
                                            value="{{ old('tanggal_kedaluwarsa') }}">
                                        @error('tanggal_kedaluwarsa')
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

                        {{-- Tabel Listing --}}
                        <div class="card card-table-custom">
                            <div class="card-header">
                                <h5>Daftar Barang Masuk</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-custom" id="tabel-barang-masuk">
                                    <thead>
                                        <tr>
                                            <th>ID Masuk</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Kedaluwarsa</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barangMasuks as $item)
                                        <tr data-id="{{ $item->id_masuk }}">
                                            <td>{{ $item->id_masuk }}</td>
                                            <td>{{ $item->produk->nama_produk }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ $item->tanggal_masuk }}</td>
                                            <td>{{ $item->tanggal_kedaluwarsa ?? '-' }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning btn-edit"
                                                    data-id="{{ $item->id_masuk }}">
                                                    Edit
                                                </button>
                                                <form method="POST"
                                                    action="{{ route('admin.barang.masuk.destroy', $item->id_masuk) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $barangMasuks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    <script>
        $(document).ready(function () {
            var defaultAction = $('#form-barang-masuk').attr('action');

            function resetForm() {
                $('#form-barang-masuk').attr('action', defaultAction);
                $('#form-_method').val('POST').prop('disabled', true);
                $('#form-title').text('Tambah Barang Masuk');
                $('#form-submit-btn').text('Simpan').removeClass('btn-warning').addClass('btn-primary');
                $('#form-cancel-btn').addClass('d-none');
                $('#form-barang-masuk')[0].reset();
                $('#tanggal_masuk').val('{{ now()->format("Y-m-d") }}').prop('readonly', true);
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            }

            $('#form-cancel-btn').on('click', function () {
                resetForm();
            });

            $(document).on('click', '.btn-edit', function (e) {
                e.preventDefault();
                var idMasuk = $(this).data('id');
                $.ajax({
                    url: "{{ url('admin/barang-masuk') }}/" + idMasuk + "/edit-data",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('#id_produk').val(data.id_produk);
                        $('#jumlah').val(data.jumlah);
                        $('#tanggal_masuk').val(data.tanggal_masuk).removeAttr('readonly');
                        $('#tanggal_kedaluwarsa').val(data.tanggal_kedaluwarsa);
                        
                        var updateUrl = "{{ url('admin/barang-masuk') }}/" + data.id_masuk;
                        $('#form-barang-masuk').attr('action', updateUrl);
                        $('#form-_method').val('PUT').prop('disabled', false);
                        
                        $('#form-title').text('Edit Barang Masuk (ID: ' + data.id_masuk + ')');
                        $('#form-submit-btn').text('Update').removeClass('btn-primary').addClass('btn-warning');
                        $('#form-cancel-btn').removeClass('d-none');
                        
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                        
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                    },
                    error: function () {
                        alert('Gagal memuat data untuk edit. Silakan coba lagi.');
                    }
                });
            });

            @if(old('_method') === 'PUT' && session('error_form_type') === 'update' && request()->query('edit_failed_id'))
                var failedId = "{{ request()->query('edit_failed_id') }}";
                // Trigger click edit untuk mengisi form kembali
                $('tr[data-id="' + failedId + '"] .btn-edit').click();
                
                // Tampilkan error validasi setelah form terisi
                setTimeout(function() {
                    var updateErrors = JSON.parse('@json($errors->update->getMessages())');
                    
                    function showError(fieldName, errors) {
                        if (errors && errors.length > 0) {
                            const field = $('#' + fieldName);
                            field.addClass('is-invalid');
                            field.closest('.mb-3').append('<div class="invalid-feedback">' + errors[0] + '</div>');
                        }
                    }

                    showError('id_produk', updateErrors.id_produk);
                    showError('jumlah', updateErrors.jumlah);
                    showError('tanggal_masuk', updateErrors.tanggal_masuk);
                    showError('tanggal_kedaluwarsa', updateErrors.tanggal_kedaluwarsa);
                }, 200);
            @endif
        });
    </script>

</body>

</html>
