@extends('admin.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Edit Data Pengguna</h1>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Edit User --}}
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" name="name" id="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
            <select name="role" id="role"
                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
            @error('role')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru (Opsional) --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                Password Baru <span class="text-gray-400">(Opsional)</span>
            </label>
            <input type="password" name="password" id="password"
                   class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-500 focus:outline-none"
                   placeholder="Isi jika ingin mengganti password">
            @error('password')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                ← Kembali
            </a>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
