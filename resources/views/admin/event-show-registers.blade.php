@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Judul Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-green-700 mb-1">
                Daftar Pendaftar — {{ $event->title }}
            </h1>
            <p class="text-gray-600 text-sm">
                Total: <span class="font-semibold text-green-600">{{ $registrations->count() }}</span> peserta
            </p>
        </div>

        <a href="{{ route('admin.event-management') }}"
           class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    {{-- Info Event --}}
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h2 class="text-lg font-semibold text-green-700 mb-2">Informasi Event</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm text-gray-700">
            <p><strong>Kategori:</strong> {{ $event->category->name ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $event->start_date->format('d M Y') }}</p>
            <p><strong>Status:</strong>
                <span class="px-3 py-1 text-xs font-semibold rounded-full
                    @if($event->status === 'ongoing') bg-green-100 text-green-700
                    @elseif($event->status === 'coming_soon') bg-yellow-100 text-yellow-700
                    @elseif($event->status === 'cancelled') bg-red-100 text-red-700
                    @elseif($event->status === 'ended') bg-gray-200 text-gray-600
                    @else bg-gray-100 text-gray-500
                    @endif">
                    {{ ucfirst(str_replace('_', ' ', $event->status)) }}
                </span>
            </p>
        </div>
    </div>

    {{-- Tabel Pendaftar --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-green-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Nama Peserta</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal Daftar</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($registrations as $index => $register)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">{{ $register->user->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $register->user->email ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $register->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full
                            @if($register->status === 'approved') bg-green-100 text-green-700
                            @elseif($register->status === 'pending') bg-yellow-100 text-yellow-700
                            @elseif($register->status === 'rejected') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ ucfirst($register->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.user-detail', $register->user_id) }}"
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Detail
                            </a>
                            <form action="{{ route('admin.registration.delete', $register->id) }}" method="POST" onsubmit="return confirm('Hapus pendaftaran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">Belum ada pendaftar untuk event ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
