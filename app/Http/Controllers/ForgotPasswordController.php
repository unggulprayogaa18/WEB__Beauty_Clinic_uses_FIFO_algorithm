<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash; // Penting untuk hashing password
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan form untuk meminta link reset password.
     */
    public function showLinkRequestForm()
    {
        return view('login.forgot_password');
    }

    /**
     * Mengirim kode OTP ke nomor WhatsApp pengguna.
     */
    public function sendResetLinkWhatsApp(Request $request)
    {
        $request->validate(['no_telepon' => 'required']);
        // Hapus '62' atau '+' di awal jika ada, ganti dengan '0'
        $phone =  $request->no_telepon;

        $user = User::where('no_telepon', $phone)->first();

        if (!$user) {
            return back()->withErrors(['no_telepon' => 'Nomor telepon tidak terdaftar.']);
        }

        // Generate kode OTP 6 digit
        $otp = rand(100000, 999999);

        // Simpan OTP dan waktu kedaluwarsa (misal: 5 menit)
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(5);
        $user->save();

        // Kirim OTP via Fonnte
        $this->kirimOtpFonnte($user, $otp);

        // Simpan nomor telepon di session untuk langkah verifikasi
        session(['phone_for_reset' => $user->no_telepon]);

        return redirect()->route('password.reset.form')->with('status', 'Kode OTP telah dikirim ke WhatsApp Anda.');
    }

    /**
     * Menampilkan form untuk mereset password.
     */
    public function showResetForm()
    {
        if (!session('phone_for_reset')) {
            return redirect()->route('password.request');
        }
        return view('login.reset_password', ['no_telepon' => session('phone_for_reset')]);
    }

    /**
     * Memproses reset password.
     */
    public function reset(Request $request)
    {
        $request->validate([
            'no_telepon' => 'required',
            'otp_code' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::where('no_telepon', $request->no_telepon)->first();

        if (!$user) {
            return back()->withErrors(['otp_code' => 'Terjadi kesalahan. Coba lagi.']);
        }

        // Cek apakah OTP valid dan belum kedaluwarsa
        if ($user->otp_code !== $request->otp_code || now()->isAfter($user->otp_expires_at)) {
            return back()->withErrors(['otp_code' => 'Kode OTP tidak valid atau telah kedaluwarsa.']);
        }

        // Update password dengan HASHING
        $user->password = $request->password;

        // Hapus OTP setelah berhasil digunakan
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Hapus session
        session()->forget('phone_for_reset');

        return redirect()->route('login.form')->with('status', 'Password Anda telah berhasil diubah! Silakan login.');
    }

    /**
     * Fungsi helper untuk mengirim OTP menggunakan Fonnte.
     */
    private function kirimOtpFonnte(User $user, string $otp)
    {
        // Ambil token dari file .env untuk keamanan
        $token = env('FONNTE_TOKEN', default: 'wW32uY7KWUThJLRfPauy'); // fallback jika tidak ada di .env

        $message = "Halo {$user->nama},\n\n"
            . "Kode OTP Anda untuk reset password adalah: *{$otp}*\n\n"
            . "Kode ini hanya berlaku selama 5 menit. Jangan berikan kode ini kepada siapapun.\n\n"
            . "Terima kasih,\nWerissa Beauty Clinic";

        try {
            Http::withHeaders([
                'Authorization' => $token,
            ])->post('https://api.fonnte.com/send', [
                        'target' => $user->no_telepon,
                        'message' => $message,
                    ]);
            Log::info("OTP berhasil dikirim ke {$user->no_telepon}");
        } catch (\Exception $e) {
            Log::error("Gagal mengirim OTP ke {$user->no_telepon}: " . $e->getMessage());
        }
    }
}
