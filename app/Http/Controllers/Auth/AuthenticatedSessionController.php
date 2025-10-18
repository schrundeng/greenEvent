<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\MagicLinkMail;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }


    public function sendMagicLink(Request $request)
{
    $user = User::where('email', $request->email)->firstOrFail();

    $token = encrypt($user->id);
    $magicLink = URL::temporarySignedRoute(
        'magic.verify',
        now()->addMinutes(15),
        ['token' => $token]
    );

    Mail::to($user->email)->send(new MagicLinkMail($user, $magicLink));

    return back()->with('success', 'Link login sudah dikirim ke email Anda.');
}

    /**
     * Handle an incoming authentication request (support username or email).
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input dasar
        $validator = Validator::make($request->all(), [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'))->with('success', 'Selamat datang Kembali, ');
            }

            return redirect()->intended(route('user.dashboard'))->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'login' => 'Email/Username atau password salah.',
        ])->onlyInput('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
