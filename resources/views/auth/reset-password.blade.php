@extends('layouts.guest')

@section('title', 'Reset Password | GreenEvent')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-green-50">
    <div class="bg-white shadow-lg rounded-2xl w-full max-w-md p-8 border border-green-200">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-green-700">🔒 Reset Your Password</h1>
            <p class="text-gray-500 text-sm mt-1">Enter your new password below to regain access to your account.</p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}"
                       class="w-full mt-1 p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                       required autofocus autocomplete="username">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input id="password" type="password" name="password"
                       class="w-full mt-1 p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                       required autocomplete="new-password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="w-full mt-1 p-2 border border-green-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                       required autocomplete="new-password">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex justify-between items-center">
                <a href="{{ route('login') }}" class="text-sm text-green-600 hover:text-green-800">
                    Back to Login
                </a>
                <button type="submit"
                        class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
