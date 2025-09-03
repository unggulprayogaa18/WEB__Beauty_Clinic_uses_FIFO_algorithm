<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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

   public function store(Request $request)
    {
        // Untuk debugging, Anda bisa uncomment baris di bawah ini untuk melihat data request
        // dd($request->all());

        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' akan mencocokkan dengan 'password_confirmation'
            'role' => ['required', Rule::in(['admin', 'manager'])],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
        ]);

        try {
            User::create([
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']), // <--- PERBAIKAN: PASSWORD DI-HASH
                'role' => $validatedData['role'],
            ]);

            return redirect()->route('admin.users.index')
                         ->with('success_user_store', 'Pengguna baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pengguna baru: ' . $e->getMessage());
            // Kirim kembali dengan error dan input sebelumnya
            return back()->withInput()
                         ->with('error_user_store', 'Gagal menambahkan pengguna. Terjadi kesalahan: ' . $e->getMessage()) // Tampilkan pesan error dari exception untuk debug
                         ->with('form_type', 'create_error'); 
        }
    }
    public function edit(User $user)
    {
        // Method ini akan dipanggil jika Anda memiliki halaman edit terpisah.
        // Jika form edit ada di halaman index, Anda mungkin tidak memerlukan ini secara langsung,
        // tapi route model binding ($user) tetap berguna untuk update.
        $users = User::orderBy('username', 'asc')->paginate(10); // Ambil semua user untuk ditampilkan di tabel
        return view('admin.users.index', compact('users', 'userToEdit')); // Kirim user yang akan diedit ke view
    }
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6|confirmed', // Password opsional saat update
            'role' => ['required', Rule::in(['admin', 'manager'])],
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan pengguna lain.',
            'password.min' => 'Password minimal harus 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Role wajib dipilih.',
            'role.in' => 'Role yang dipilih tidak valid.',
        ]);

        try {
            $dataToUpdate = [
                'username' => $validatedData['username'],
                'role' => $validatedData['role'],
            ];

            if (!empty($validatedData['password'])) {
                $dataToUpdate['password'] = $validatedData['password']; // HASH PASSWORD JIKA DIUBAH
            }

            $user->update($dataToUpdate);

            return redirect()->route('admin.users.index')
                ->with('success_user_store', 'Data pengguna berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error saat update pengguna (ID: ' . $user->id . '): ' . $e->getMessage());
            return back()->withInput()
                ->with('error_user_store', 'Gagal memperbarui data pengguna. Silakan coba lagi.')
                ->with('form_type', 'update_error') // Untuk membantu JS di view
                ->with('editing_user_id', $user->id); // Untuk membantu JS di view
        }
    }
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
