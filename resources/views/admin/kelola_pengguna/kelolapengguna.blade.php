<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Spica Admin - Kelola Pengguna</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller d-flex">
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
                <li class="nav-item active">
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
                    <a class="nav-link" data-bs-toggle="collapse" href="#laporan" aria-expanded="false" aria-controls="laporan">
                        <i class="mdi mdi-file-document-box-multiple menu-icon"></i>
                        <span class="menu-title">Laporan</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.laporan_barang_masuk') }}">Laporan Barang Masuk</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.laporan_barang_keluar') }}">Laporan Barang Keluar</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.laporan_antrian') }}">Laporan Antrian</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.produk.daftarproduk') }}">Laporan Stok</a></li>
                            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.laporan_barang_terlaris') }}">Laporan Barang Terlaku</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row">
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1" style="margin-left: 40px;">KELOLA PENGGUNA</h4>
                    <div class="navbar-brand-wrapper">
                        <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}" width="120px" alt="logo" /></a>
                        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{ asset('assets/images/11880487944aa78dec-f55d-4b45-8b07-5e6ac3cc350d-removebg-preview.png') }}" alt="logo" /></a>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item">
                            <h4 class="mb-0 font-weight-bold d-none d-xl-block" id="tanggal-sekarang-js"></h4>
                        </li>
                        <li class="nav-item dropdown me-2">
                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                @csrf
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary me-2"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0" id="userFormTitle">Tambah Pengguna Baru</h4>
                                </div>
                                <div class="card-body">
                                    {{-- Notifikasi error validasi default dari Laravel (opsional, karena sudah ditangani SweetAlert) --}}
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif

                                    <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
                                        @csrf
                                        <input type="hidden" name="user_id" id="user_id">
                                        <div class="form-group">
                                            <label for="username">Username <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Masukkan username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span>
                                                <small id="passwordHelp" class="form-text text-muted">(Min. 6 karakter. Kosongkan jika tidak ingin mengubah saat edit)</small>
                                            </label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password">
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role <span class="text-danger">*</span></label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                                            <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ old('no_telepon') }}" placeholder="Contoh: 081234567890" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Simpan Pengguna</button>
                                        <button type="reset" class="btn btn-light" id="cancelEditButton" style="display: none;">Batal Edit</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Daftar Pengguna</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="searchUserInput" placeholder="Cari pengguna (ID, Username, Role)...">
                                    </div>
                                    <div class="table-responsive mt-3">
                                        <table class="table table-hover" id="usersTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Username</th>
                                                    <th>Role</th>
                                                    <th>Dibuat Pada</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $user->role == 'admin' ? 'danger' : 'info' }}">{{ ucfirst($user->role) }}</span>
                                                    </td>
                                                    <td>
                                                        @if ($user->created_at)
                                                        {{ $user->created_at->format('d M Y, H:i') }}
                                                        @else
                                                        N/A
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{-- Tombol Edit bisa diimplementasikan dengan JS untuk mengisi form di sebelah kiri --}}
                                                        {{-- <button class="btn btn-warning btn-sm edit-user-btn" data-id="{{ $user->id }}" title="Edit"><i class="mdi mdi-pencil"></i></button> --}}

                                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin ingin menghapus pengguna ini?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data pengguna ditemukan.</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-3">
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Notifikasi untuk Create/Update Pengguna (Sukses)
            @if(session('success_user_store'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success_user_store') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

            // Notifikasi untuk Delete Pengguna (Sukses)
            @if(session('success_user_delete'))
            Swal.fire({
                title: 'Berhasil Dihapus!',
                text: '{{ session('success_user_delete') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            @endif

            // Notifikasi untuk Delete Pengguna (Gagal)
            @if(session('error_user_delete'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error_user_delete') }}',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
            @endif

            // Notifikasi untuk Create/Update Pengguna (Gagal)
            @if(session('error_user_store'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error_user_store') }}',
                icon: 'error',
                confirmButtonText: 'Coba Lagi'
            });
            @endif

            // Script untuk menampilkan Tanggal
            const elemenTanggal = document.getElementById('tanggal-sekarang-js');
            if (elemenTanggal) {
                const tanggalFormatted = new Date().toLocaleDateString('id-ID', {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric'
                });
                elemenTanggal.textContent = tanggalFormatted;
            }

            // Script untuk Pencarian Pengguna di Tabel
            const searchInput = document.getElementById('searchUserInput');
            if (searchInput) {
                const tableBody = document.getElementById('usersTable').getElementsByTagName('tbody')[0];
                const tableRows = tableBody.getElementsByTagName('tr');

                searchInput.addEventListener('keyup', function(event) {
                    const searchTerm = event.target.value.toLowerCase();
                    for (let row of tableRows) {
                        // Pastikan row bukan row "data tidak ditemukan"
                        if (row.getElementsByTagName('td').length > 1) {
                            if (row.textContent.toLowerCase().includes(searchTerm)) {
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
</body>

</html>