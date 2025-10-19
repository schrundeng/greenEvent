<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    private function checkRole($role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak: Anda tidak memiliki izin untuk mengakses halaman ini.');
        }
    }

    // hanya admin yang bisa melihat semua user
    public function index()
    {
        $this->checkRole('admin');

        $users = User::paginate(10);
        return view('admin.user-management', compact('users'));
    }

    // hanya user yang bisa mengakses profilnya
    public function profile()
    {
        $this->checkRole('user');

        $user = Auth::user();
        return view('user.user-profile', compact('user'));
    }

    // hanya user yang bisa edit profilnya
    public function edit()
    {
        $this->checkRole('user');

        $user = Auth::user();
        return view('user.user-edit- profile', compact('user'));
    }

    // hanya admin yang bisa export data user
    public function export()
    {
        $this->checkRole('admin');

        $filename = 'data_pengguna_' . now()->format('Ymd_His') . '.csv';
        $users = User::select('id', 'name', 'username', 'email', 'role', 'created_at')->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ];

        $callback = function () use ($users) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nama', 'Username', 'Email', 'Role', 'Tanggal Daftar']);
            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->name,
                    $user->username,
                    $user->email,
                    ucfirst($user->role),
                    $user->created_at->format('d-m-Y'),
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    // hanya user yang bisa update profilnya sendiri
    public function update(Request $request)
    {
        $this->checkRole('user');

        $user = Auth::user();

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user->username = $validated['username'];

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $this->checkRole('admin');

        if (Auth::id() === $user->id) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }
}
