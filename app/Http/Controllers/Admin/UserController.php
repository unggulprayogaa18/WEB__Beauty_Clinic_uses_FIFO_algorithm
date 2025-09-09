<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException; // <-- Penting: Tambahkan ini

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua pengguna, urutkan berdasarkan username secara ascending,
        // dan gunakan paginasi (misalnya 10 pengguna per halaman).
        $users = User::orderBy('username', 'asc')->paginate(10);

        return view('admin.kelola_pengguna.kelolapengguna', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // ==================== BLOK PERBAIKAN ====================
            $validatedData = $request->validate([
                'username' => 'required|string|max:255|unique:users,username',
                'password' => 'required|string|min:6|confirmed',
                'role' => ['required', Rule::in(['admin', 'manager'])],
                'no_telepon' => 'required|numeric|min:10', // <-- GANTI 'integer' menjadi 'numeric'
            ], [
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username ini sudah digunakan.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal harus 6 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'role.required' => 'Role wajib dipilih.',
                'role.in' => 'Role yang dipilih tidak valid.',
                'no_telepon.required' => 'Nomor telepon wajib diisi.',
                'no_telepon.numeric' => 'Nomor telepon hanya boleh berisi angka.', // <-- Pesan error disesuaikan
                'no_telepon.min' => 'Nomor telepon minimal harus 10 digit.', // <-- Pesan error disesuaikan
            ]);
            // ================= END BLOK PERBAIKAN =================

            User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'role' => $validatedData['role'],
                'no_telepon' => $validatedData['no_telepon'],
            ]);

            return redirect()->route('admin.users.index')
                ->with('success_user_store', 'Pengguna baru berhasil ditambahkan!');

        } catch (ValidationException $e) {
            // Log error validasi secara spesifik untuk debugging
            Log::error('Gagal validasi saat menambah pengguna baru: ' . $e->getMessage(), $e->errors());
            // Redirect kembali dengan pesan error dari validasi untuk ditampilkan di form
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error_user_store', 'Gagal menambahkan pengguna. Periksa kembali data yang Anda masukkan.');

        } catch (\Exception $e) {
            // Log error umum lainnya (misal, koneksi database gagal)
            Log::error('Error saat menyimpan pengguna baru: ' . $e->getMessage());
            return back()->withInput()
                ->with('error_user_store', 'Terjadi kesalahan pada server. Gagal menambahkan pengguna.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // NOTE: Method ini biasanya untuk halaman edit terpisah.
        // Jika form edit digabung di halaman index, method ini mungkin tidak terpakai
        // dan logika update langsung ditangani oleh method update().
        $users = User::orderBy('username', 'asc')->paginate(10);
        return view('admin.kelola_pengguna.kelolapengguna', [
            'users' => $users,
            'userToEdit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed', // Password opsional saat update
            'role' => ['required', Rule::in(['admin', 'manager'])],
            'no_telepon' => ['required', 'numeric', 'min:10'], // Pastikan validasi update juga benar
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan pengguna lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'no_telepon.required' => 'Nomor telepon wajib diisi.',
            'no_telepon.numeric' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        try {
            $user->username = $validatedData['username'];
            $user->role = $validatedData['role'];
            $user->no_telepon = $validatedData['no_telepon'];

            if (!empty($validatedData['password'])) {
                $user->password = Hash::make($validatedData['password']); // HASH PASSWORD JIKA DIUBAH
            }

            $user->save();

            return redirect()->route('admin.users.index')
                ->with('success_user_store', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error saat update pengguna (ID: ' . $user->id . '): ' . $e->getMessage());
            return back()->withInput()
                ->with('error_user_store', 'Gagal memperbarui data pengguna. Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Mencegah admin menghapus dirinya sendiri
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')
                ->with('error_user_delete', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        try {
            $username = $user->username;
            $user->delete();
            return redirect()->route('admin.users.index')
                ->with('success_user_delete', "Pengguna '{$username}' berhasil dihapus.");
        } catch (\Exception $e) {
            Log::error('Error saat menghapus pengguna (ID: ' . $user->id . '): ' . $e->getMessage());
            return redirect()->route('admin.users.index')
                ->with('error_user_delete', 'Gagal menghapus pengguna. Silakan coba lagi.');
        }
    }
}