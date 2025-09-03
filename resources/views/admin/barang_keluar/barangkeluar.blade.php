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
                        KELUAR</h4>
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
                        @if ($errors->update->any() && !$errors->update->has('id_produk') && !$errors->update->has('jumlah') && !$errors->update->has('tanggal_keluar'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->update->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Form Create/Edit --}}
                        <div class="card card-form-custom mb-4">
                            <div class="card-header">
                                <h5 id="form-title-keluar">Tambah Barang Keluar</h5>
                            </div>
                            <div class="card-body">
                                <form id="form-barang-keluar" method="POST"
                                    action="{{ route('admin.barang.keluar.store') }}">
                                    @csrf
                                    <input type="hidden" name="_method" id="form-keluar-_method" value="POST">
                                    <div class="mb-3">
                                        <label for="id_produk_keluar" class="form-label">Produk</label>
                                        <select name="id_produk" id="id_produk_keluar"
                                            class="form-select @error('id_produk', 'store') is-invalid @enderror @if($errors->update->has('id_produk')) is-invalid @endif">
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach($produks as $produk)
                                            @php
                                            $style = '';
                                            $expiryText = '';
                                            if ($produk->fifo_kedaluwarsa) {
                                            $tgl_kedaluwarsa = \Carbon\Carbon::parse($produk->fifo_kedaluwarsa);
                                            $expiryText = ' (Exp: ' . $tgl_kedaluwarsa->format('d/m/Y') . ')';
                                            if ($tgl_kedaluwarsa->isSameMonth(\Carbon\Carbon::now())) {
                                            $style = 'style="color: red; font-weight: bold;"';
                                            }
                                            }
                                            @endphp
                                            <option value="{{ $produk->id_produk }}"
                                                {{ old('id_produk', optional($barangKeluarToEdit ?? null)->id_produk) == $produk->id_produk ? 'selected' : '' }}
                                                {!! $style !!}>
                                                {{ $produk->nama_produk }}
                                                (Stok: {{ $produk->total_stok ?? 0 }})
                                                {{ $expiryText }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('id_produk', 'store')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                        @if($errors->update->has('id_produk'))
                                        <div class="invalid-feedback d-block">
                                            @foreach ($errors->update->get('id_produk') as $message)
                                            {{ $message }}<br>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="jumlah_keluar" class="form-label">Jumlah</label>
                                        <input type="number" name="jumlah" id="jumlah_keluar"
                                            class="form-control @error('jumlah', 'store') is-invalid @enderror @if($errors->update->has('jumlah')) is-invalid @endif"
                                            min="1" value="{{ old('jumlah') }}">
                                        @error('jumlah', 'store')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($errors->update->has('jumlah'))
                                        <div class="invalid-feedback d-block">
                                            @foreach ($errors->update->get('jumlah') as $message)
                                            {{ $message }}<br>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_keluar_input" class="form-label">Tanggal Keluar</label>
                                        <input type="date" name="tanggal_keluar" id="tanggal_keluar_input"
                                            class="form-control @error('tanggal_keluar', 'store') is-invalid @enderror @if($errors->update && $errors->update->has('tanggal_keluar')) is-invalid @endif"
                                            value="{{ old('tanggal_keluar', now()->format('Y-m-d')) }}" readonly>
                                        @error('tanggal_keluar', 'store')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        @if($errors->update && $errors->update->has('tanggal_keluar'))
                                        <div class="invalid-feedback d-block">
                                            @foreach ($errors->update->get('tanggal_keluar') as $message)
                                            {{ $message }}<br>
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
                                    <button type="submit" id="form-keluar-submit-btn" class="btn btn-primary">
                                        Simpan
                                    </button>
                                    <button type="button" id="form-keluar-cancel-btn"
                                        class="btn btn-secondary d-none">
                                        Batal
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Tabel Listing --}}
                        <div class="card card-table-custom">
                            <div class="card-header">
                                <h5>Daftar Barang Keluar</h5>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-custom" id="tabel-barang-keluar">
                                    <thead>
                                        <tr>
                                            <th>ID Keluar</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($barangKeluars as $item)
                                        <tr data-id="{{ $item->id_keluar }}">
                                            <td>{{ $item->id_keluar }}</td>
                                            <td>{{ $item->produk->nama_produk ?? 'Produk Tidak Ditemukan' }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('admin.barang.keluar.destroy', $item->id_keluar) }}"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini? Stok produk akan dikembalikan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Belum ada data barang keluar.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                @if ($barangKeluars->hasPages())
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $barangKeluars->links() }}
                                </div>
                                @endif
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
            var defaultActionKeluar = $('#form-barang-keluar').attr('action');
            var defaultTitleKeluar = $('#form-title-keluar').text();

            function resetFormKeluar() {
                $('#form-barang-keluar').attr('action', defaultActionKeluar);
                $('#form-keluar-_method').val('POST');
                $('#form-title-keluar').text(defaultTitleKeluar);
                $('#form-keluar-submit-btn').text('Simpan').removeClass('btn-warning').addClass('btn-primary');
                $('#form-keluar-cancel-btn').addClass('d-none');
                $('#form-barang-keluar')[0].reset();
                 $('#tanggal_keluar_input').val('{{ now()->format("Y-m-d") }}');
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').remove();
            }

            $('#form-keluar-cancel-btn').on('click', function () {
                resetFormKeluar();
            });

            $(document).on('click', '.btn-edit-keluar', function (e) {
                e.preventDefault();
                var idKeluar = $(this).data('id');
                $('.is-invalid, .invalid-feedback').remove();

                $.ajax({
                    url: "{{ url('admin/barang-keluar') }}/" + idKeluar + "/edit",
                    method: "GET",
                    dataType: "json",
                    success: function (data) {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        $('#id_produk_keluar').val(data.id_produk);
                        $('#jumlah_keluar').val(data.jumlah);
                        $('#tanggal_keluar_input').val(data.tanggal_keluar).removeAttr('readonly');
                        
                        var updateUrlKeluar = "{{ url('admin/barang-keluar') }}/" + data.id_keluar;
                        $('#form-barang-keluar').attr('action', updateUrlKeluar);
                        $('#form-keluar-_method').val('PUT');
                        
                        $('#form-title-keluar').text('Edit Barang Keluar (ID: ' + data.id_keluar + ')');
                        $('#form-keluar-submit-btn').text('Update').removeClass('btn-primary').addClass('btn-warning');
                        $('#form-keluar-cancel-btn').removeClass('d-none');
                        
                        $('html, body').animate({ scrollTop: 0 }, 'slow');
                    },
                    error: function (xhr) {
                        alert('Gagal memuat data. Error: ' + xhr.statusText);
                    }
                });
            });

            @if(session('error_form_type') === 'update' && request()->query('edit_failed_id'))
                var failedIdKeluar = @json(request()->query('edit_failed_id'));
                if (failedIdKeluar) {
                    $('tr[data-id="' + failedIdKeluar + '"] .btn-edit-keluar').click();
                }
            @endif
        });
    </script>
</body>

</html>
