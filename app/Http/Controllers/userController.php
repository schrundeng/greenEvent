<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users = User::paginate(10);
        return view('admin.user-management', compact('users'));
    }
    public function profile()
    {
        $user = Auth::user();
        return view('user.user-profile', compact('user'));
       
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.user-edit-profile', compact('user'));
    }
public function export()
{
    $filename = 'data_pengguna_' . now()->format('Ymd_His') . '.csv';

    $users = \App\Models\User::select('id', 'name', 'username', 'email', 'role', 'created_at')->get();

    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename={$filename}",
    ];

    $callback = function () use ($users) {
        $handle = fopen('php://output', 'w');
        // Header kolom
        fputcsv($handle, ['ID', 'Nama', 'Username', 'Email', 'Role', 'Tanggal Daftar']);
        // Isi data
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


  public function update(Request $request)
{
    $user = Auth::user();

    $validated = $request->validate([
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'password' => 'nullable|string|min:8',
    ]);

    // Update username
    $user->username = $validated['username'];

    // Jika user isi password baru
    if ($request->filled('password')) {
        $user->password = Hash::make($validated['password']);
    }

    $user->save();

    return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui!');
}

}
