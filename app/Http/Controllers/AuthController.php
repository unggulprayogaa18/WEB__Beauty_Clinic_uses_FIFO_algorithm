<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        // 1. Log data yang masuk dari form
        Log::info('Percobaan login dimulai.', [
            'username_input' => $request->username,
            'password_input_length' => strlen($request->password) // Log panjang password, bukan passwordnya
        ]);

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // 2. Cari pengguna berdasarkan username
        $user = User::where('username', $request->username)->first();

        // 3. Periksa apakah pengguna ditemukan
        if ($user) {
            Log::info('Pengguna ditemukan di database.', ['username_db' => $user->username]);

            // 4. Bandingkan password dan log hasilnya
            // INI HANYA UNTUK DEBUGGING DI LOKAL. JANGAN GUNAKAN DI SERVER PRODUKSI.
            Log::debug('Membandingkan password.', [
                'password_dari_form' => $request->password,
                'password_dari_db' => $user->password,
                'hasil_perbandingan' => ($user->password === $request->password) ? 'COCOK' : 'TIDAK COCOK'
            ]);

            if ($user->password === $request->password) {
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
            }
        } else {
            // Log jika pengguna tidak ditemukan
            Log::warning('Pengguna tidak ditemukan.', ['username_input' => $request->username]);
        }

        // 5. Log jika otentikasi gagal total
        Log::error('Otentikasi gagal, pengguna dikembalikan ke halaman login.');
        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        // 1. Logout pengguna yang sedang aktif
        Auth::logout();

        // 2. Invalidate session pengguna untuk keamanan
        $request->session()->invalidate();

        // 3. Regenerate token session untuk mencegah serangan session fixation
        $request->session()->regenerateToken();

        // 4. Arahkan pengguna kembali ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }

}
