@extends('admin.layout')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    {{-- Judul Halaman --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-green-700 mb-1">
                Daftar Pendaftar — {{ $event->title ?? '-' }}
            </h1>
            <p class="text-gray-600 text-sm">
                Total: <span class="font-semibold text-green-600">{{ $registrations->count() ?? 0 }}</span> peserta
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
            <p><strong>Kategori:</strong> {{ optional($event->category)->name ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ isset($event->start_date) ? \Carbon\Carbon::parse($event->start_date)->format('d M Y') : '-' }}</p>
            <p><strong>Status:</strong>
                <span class="px-3 py-1 text-xs font-semibold rounded-full
                    @if($event->status === 'ongoing') bg-green-100 text-green-700
                    @elseif($event->status === 'coming_soon') bg-yellow-100 text-yellow-700
                    @elseif($event->status === 'cancelled') bg-red-100 text-red-700
                    @elseif($event->status === 'ended') bg-gray-200 text-gray-600
                    @else bg-gray-100 text-gray-500
                    @endif }}">
                    {{ $event->status ? ucfirst(str_replace('_', ' ', $event->status)) : '-' }}
                </span>
            </p>
        </div>
    </div>

    {{-- Tabel Pendaftar --}}
    <div class="shadow mt-10 overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white select-none">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama Peserta</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Daftar</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($registrations as $index => $register)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 font-medium text-gray-900">{{ optional($register->user)->name ?? $register->name ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ optional($register->user)->email ?? $register->email ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ isset($register->registered_at) ? $register->registered_at->format('d M Y, H:i') : '-' }}</td>
                    <td class="px-4 py-2 text-sm space-x-2 flex">
                        <form action="{{ route('admin.registration.change-status', $register->id) }}" method="POST">
                            @csrf
                            <select name="status" class="px-7 py-1 pl-3 text-sm rounded border">
                                <option value="pending" {{ $register->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $register->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $register->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="ml-1 px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">
                                Update
                            </button>
                        </form>
                        <form action="{{ route('admin.registration.admin-destroy', $register->id) }}" method="POST" onsubmit="return confirm('Hapus pendaftaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-6">
                        Belum ada pendaftar untuk event ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection