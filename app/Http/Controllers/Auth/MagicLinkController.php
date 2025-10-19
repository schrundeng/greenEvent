<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Mail\MagicLinkMail;

class MagicLinkController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password');
    }

    public function sendLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $user = User::where('email', $request->email)->firstOrFail();

        $token = encrypt($user->id);

        $magicLink = URL::temporarySignedRoute(
            'magic.reset',
            now()->addMinutes(15),
            ['token' => $token]
        );

        Mail::to($user->email)->send(new MagicLinkMail($user, $magicLink));

        return back()->with('status', 'Tautan untuk mengatur ulang kata sandi telah dikirim ke email Anda.');
    }

    public function showResetForm(Request $request, $token)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Link kadaluarsa atau tidak valid.');
        }

        $userId = decrypt($token);
        $user = User::findOrFail($userId);

        return view('auth.reset-password', [
            'token' => $token,
            'email' => $user->email, // pass email directly
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $userId = decrypt($request->token);
            $user = User::findOrFail($userId);

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Password berhasil diubah!');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Token tidak valid atau kadaluarsa.']);
        }
    }
}
