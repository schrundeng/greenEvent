@extends('user.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-green-700 mb-6 text-center sm:text-left">Edit Profil</h1>

    <div class="bg-white shadow-md rounded-lg p-6 sm:p-8">
        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm sm:text-base">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('user.user-update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div>
                <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" id="username" name="username"
                    value="{{-- auth()->user()->username --}}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-green-500"
                    required>
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ auth()->user()->email }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm sm:text-base bg-gray-100 text-gray-500 cursor-not-allowed"
                    readonly>
            </div>

            {{-- Password Baru --}}
            <div>
                <label for="password" class="block text-gray-700 font-semibold mb-1">
                    Password Baru
                    <span class="text-gray-400 text-xs sm:text-sm">(kosongkan jika tidak ingin ganti)</span>
                </label>
                <input type="password" id="password" name="password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            {{-- Password Lama --}}
            <div>
                <label for="current_password" class="block text-gray-700 font-semibold mb-1">Password Lama</label>
                <input type="password" id="current_password" name="current_password"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm sm:text-base focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                <a href="{{ route('user.profile') }}"
                    class="px-5 py-2 bg-gray-300 text-gray-800 text-center rounded-md hover:bg-gray-400 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
