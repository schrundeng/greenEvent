<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user-management', compact('users'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.user-edit-profile', compact('user'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.user-profile', compact('user'));
       
    }

    public function update(Request $request)
    {
         $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($validated);

        return redirect()->route('user.user-profile')->with('success', 'Profile updated successfully.');
    }
}
