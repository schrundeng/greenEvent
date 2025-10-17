@extends('user.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Edit Profil</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{--route('user.profile.update')--}}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="username" class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" id="username" name="username" value="{{-- auth()->user()->username --}}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email}}"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" readonly>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-semibold mb-1">
                    Password Baru <span class="text-gray-400 text-sm">(kosongkan jika tidak ingin ganti)</span>
                </label>
                <input type="password" id="password" name="password"
                       class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{-- route('user.profile') --}}" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Batal</a>
                <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
