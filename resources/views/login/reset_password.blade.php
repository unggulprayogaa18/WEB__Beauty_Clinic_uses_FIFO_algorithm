<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Werissa Beauty Clinic</title>
    {{-- Sama seperti file sebelumnya, salin CSS dari halaman login Anda ke sini --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary-color: #670D2F; --primary-hover: #530a25; --text-dark: #333; --text-light: #777; --border-color: #ddd; --light-bg: #f9f9f9; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--light-bg); display: flex; align-items: center; justify-content: center; min-height: 100vh; margin: 0; padding: 20px; }
        .login-container { display: flex; width: 100%; max-width: 900px; min-height: 550px; background-color: #fff; box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1); border-radius: 20px; overflow: hidden; }
        .login-image-side { flex: 1; background-image: url('https://images.pexels.com/photos/3985321/pexels-photo-3985321.jpeg'); background-size: cover; background-position: center; position: relative; }
        .login-form-side { flex: 1; padding: 50px 40px; display: flex; flex-direction: column; justify-content: center; }
        .login-header { text-align: center; margin-bottom: 30px; }
        .login-header h2 { color: var(--primary-color); font-weight: 600; font-size: 2rem; margin-bottom: 5px; }
        .login-header p { color: var(--text-light); font-size: 0.95rem; }
        .form-group { position: relative; margin-bottom: 25px; }
        .form-control { border: none; border-bottom: 2px solid var(--border-color); border-radius: 0; padding: 10px 10px 10px 35px; font-size: 1rem; background-color: transparent; transition: border-color 0.3s; }
        .form-control:focus { outline: none; box-shadow: none; border-color: var(--primary-color); }
        .form-icon { position: absolute; left: 5px; top: 50%; transform: translateY(-50%); color: var(--text-light); transition: color 0.3s; }
        .form-control:focus + .form-icon { color: var(--primary-color); }
        .btn-custom { background-color: var(--primary-color); border: none; color: #fff; padding: 12px; border-radius: 10px; font-weight: 500; font-size: 1rem; cursor: pointer; transition: background-color 0.3s, transform 0.2s; box-shadow: 0 4px 15px rgba(103, 13, 47, 0.2); }
        .btn-custom:hover { background-color: var(--primary-hover); transform: translateY(-2px); color: #fff; }
        .error-message, .status-message { padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-size: 0.9em; }
        .error-message { color: #d9534f; background-color: #f8d7da; border: 1px solid #f5c6cb; }
        .status-message { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; }
        @media (max-width: 768px) { .login-container { flex-direction: column; min-height: auto; max-width: 400px; } .login-image-side { display: none; } .login-form-side { padding: 40px 30px; } }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image-side"></div>
        <div class="login-form-side">
            <div class="login-header">
                <h2>Buat Password Baru</h2>
                <p>Masukkan kode OTP dan password baru Anda.</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif
            @if (session('status'))
                <div class="status-message">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="no_telepon" value="{{ $no_telepon }}">

                <div class="form-group">
                    <input type="text" name="otp_code" id="otp_code" class="form-control" placeholder="Kode OTP" required>
                    <i class="fas fa-key form-icon"></i>
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password Baru" required>
                    <i class="fas fa-lock form-icon"></i>
                </div>

                <div class="form-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                    <i class="fas fa-lock form-icon"></i>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-custom">Reset Password</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
{{-- ```

---

### Langkah 5: Perbarui Tampilan Login

Buka kembali file view login Anda (misal `resources/views/login/login.blade.php`) dan ubah link "Lupa Password?".

Cari baris ini:
```html
<a href="#" class="forgot-password-link">Lupa Password?</a>
```

Ubah menjadi:
```html
<a href="{{ route('password.request') }}" class="forgot-password-link">Lupa Password?</a>
```

---

### Langkah 6: Atur Token Fonnte di `.env`

Untuk keamanan, pindahkan token Fonnte Anda ke file `.env`.

1.  Buka file `.env` di direktori utama proyek Anda.
2.  Tambahkan baris ini di bagian bawah:
    ```
    FONNTE_TOKEN=aUNu6q88rhW5ZycH5L7m
    ```
    Ganti dengan token Anda yang sebenarnya.

---

### Perbaikan Keamanan: Terapkan Hashing pada Login

Terakhir dan **SANGAT PENTING**. Buka `AuthController.php` Anda dan ubah fungsi `login` untuk menggunakan `Hash::check()`.

Ganti blok ini di `AuthController.php`:

```php
// if ($user->password === $request->password) { ... } // INI TIDAK AMAN
```

Menjadi blok ini:

```php
use Illuminate\Support\Facades\Hash; // Pastikan ini ada di bagian atas file

// ...

// 4. Bandingkan password yang sudah di-hash
if (Hash::check($request->password, $user->password)) {
    Log::info('Password cocok. Proses login pengguna.', ['username' => $user->username]);
    Auth::login($user);

    $log_message = 'Mengalihkan ke dashboard ' . $user->role;
    Log::info($log_message);

    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'manager') {
        return redirect('/manager/dashboard');
    }
} else {
    // Log jika password tidak cocok
    Log::warning('Password tidak cocok untuk pengguna.', ['username' => $request->username]);
} --}}
