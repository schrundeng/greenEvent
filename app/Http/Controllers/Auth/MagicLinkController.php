<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Mail\MagicLinkMail;
use Illuminate\Contracts\Mail\Mailable;

class MagicLinkController extends Controller
{
    public function showForm()
    {
        return view('auth.forgot-password'); // form isi email
    }

    public function sendLink(Request $request)
{
    $request->validate(['email' => 'required|email|exists:users,email']);

    $user = User::where('email', $request->email)->firstOrFail();

    // token terenkripsi berisi user id
    $token = encrypt($user->id);

    // buat signed temporary URL ke route 'magic.verify'
    $magicLink = URL::temporarySignedRoute(
        'magic.verify',
        now()->addMinutes(15),
        ['token' => $token]
    );

    // kirim email — pastikan MagicLinkMail menerima ($user, $magicLink)
    Mail::to($user->email)->send(new MagicLinkMail($user, $magicLink));

    return back()->with('status', 'Link login telah dikirim ke email Anda.');
}

    public function verify(Request $request, $token)
    {
        try {
            // Cek apakah link masih valid (signature valid)
            if (!$request->hasValidSignature()) {
                abort(403, 'Link kadaluarsa atau tidak valid.');
            }

            // Ambil user id dari token terenkripsi
            $userId = decrypt($token);
            $user = User::findOrFail($userId);

            // Login otomatis
            Auth::login($user);

            return redirect()->route('/dashboard')->with('success', 'Login berhasil melalui verifikasi email!');
        } catch (\Exception $e) {
            return redirect()->route('magic.login')->with('error', 'Link tidak valid.');
        }
    }
}
