@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Detail Pengguna</h1>

    {{-- Tombol kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.users.index') }}" 
           class="inline-block px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
           ← Kembali ke Daftar Pengguna
        </a>
    </div>

    {{-- Data Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div>
            <p class="text-sm text-gray-500">Nama Lengkap</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Email</p>
            <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Role</p>
            <span class="inline-block px-3 py-1 rounded text-sm font-medium 
                         {{ $user->role === 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                {{ ucfirst($user->role) }}
            </span>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal Bergabung</p>
            <p class="text-lg font-semibold text-gray-800">
                {{ $user->created_at->format('d M Y, H:i') }}
            </p>
        </div>
    </div>

    {{-- Statistik Pengguna --}}
    <div class="bg-green-50 p-6 rounded-lg border border-green-100 mb-8">
        <h2 class="text-lg font-semibold text-green-700 mb-3">Statistik Aktivitas</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <p class="text-sm text-gray-500">Event Didaftarkan</p>
                <p class="text-2xl font-bold text-green-700">{{ $user->registrations_count ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <p class="text-sm text-gray-500">Event Dibatalkan</p>
                <p class="text-2xl font-bold text-red-600">{{ $user->registrations_cancelled ?? 0 }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow-sm text-center">
                <p class="text-sm text-gray-500">Event Selesai</p>
                <p class="text-2xl font-bold text-gray-700">{{ $user->registrations_finished ?? 0 }}</p>
            </div>
        </div>
    </div>

    {{-- Riwayat Event --}}
    <div>
        <h2 class="text-lg font-semibold text-green-700 mb-4">Riwayat Event</h2>

        @if($registrations->isEmpty())
            <p class="text-gray-500">Belum ada event yang diikuti pengguna ini.</p>
        @else
            <div class="space-y-4">
                @foreach($registrations as $reg)
                    <div class="bg-white border rounded-lg shadow-sm p-4 flex justify-between items-center hover:shadow-md transition">
                        <div>
                            <p class="font-semibold text-lg">{{ $reg->event->title }}</p>
                            <p class="text-sm text-gray-600">📅 {{ $reg->event->start_date->format('d/m/Y') }} - {{ $reg->event->end_date->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-600">📍 {{ $reg->event->location }}</p>
                            <p class="text-sm text-gray-500">Status: <span class="font-medium">{{ ucfirst($reg->status) }}</span></p>
                        </div>
                        <a href="{{ route('admin.events.show', $reg->event->id) }}" 
                           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
