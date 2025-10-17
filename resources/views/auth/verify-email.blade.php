@extends('layouts.guest')

@section('title', 'Verify Your Email | GreenEvent')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-50">
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8 border border-green-200">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-700">📧 Verify Your Email</h1>
            <p class="text-gray-500 text-sm mt-1">
                Thanks for joining GreenEvent! Before you can continue, please verify your email by clicking the link we’ve just sent to your inbox.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 text-center bg-green-100 border border-green-300 rounded-lg p-2">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="flex flex-col space-y-4 mt-6">
            <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                @csrf
                <button type="submit"
                        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="text-center">
                @csrf
                <button type="submit"
                        class="w-full underline text-sm text-gray-600 hover:text-green-700 transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
