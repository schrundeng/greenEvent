@extends('admin.layout')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">

    {{-- 🔹 Judul Halaman --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-3">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-green-700 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-clipboard-list"></i>
                Daftar Pendaftar — {{ $event->title ?? '-' }}
            </h1>
            <p class="text-gray-600 text-sm">
                <i class="fa-solid fa-users text-green-600 mr-1"></i>
                Total:
                <span class="font-semibold text-green-600">
                    {{ $registrations->count() ?? 0 }}
                </span> peserta
            </p>
        </div>

        <a href="{{ route('admin.event-management') }}"
            class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow transition text-sm font-medium">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    {{-- 🔹 Info Event --}}
    <div class="bg-white shadow rounded-lg p-5 mb-6">
        <h2 class="text-lg font-semibold text-green-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-circle-info"></i>
            Informasi Event
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-700">
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-layer-group text-green-600"></i>
                <strong>Kategori:</strong> {{ optional($event->category)->name ?? '-' }}
            </p>
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-green-600"></i>
                <strong>Tanggal:</strong>
                {{ isset($event->start_date)
                    ? \Carbon\Carbon::parse($event->start_date)->format('d M Y')
                    : '-' }}
            </p>
            <p class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check text-green-600"></i>
                <strong>Status:</strong>
                <span class="px-3 py-1 text-xs font-semibold rounded-full
                    @if($event->status === 'ongoing') bg-green-100 text-green-700
                    @elseif($event->status === 'coming_soon') bg-yellow-100 text-yellow-700
                    @elseif($event->status === 'cancelled') bg-red-100 text-red-700
                    @elseif($event->status === 'ended') bg-gray-200 text-gray-600
                    @else bg-gray-100 text-gray-500
                    @endif">
                    {{ $event->status ? ucfirst(str_replace('_', ' ', $event->status)) : '-' }}
                </span>
            </p>
        </div>
    </div>

    {{-- 🔹 Tabel Pendaftar --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">
                            <i class="fa-solid fa-hashtag mr-1"></i> #
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            <i class="fa-solid fa-user mr-1"></i> Nama Peserta
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            <i class="fa-solid fa-envelope mr-1"></i> Email
                        </th>
                        <th class="px-4 py-3 text-left font-semibold">
                            <i class="fa-solid fa-calendar-check mr-1"></i> Tanggal Daftar
                        </th>
                        <th class="px-4 py-3 text-center font-semibold">
                            <i class="fa-solid fa-gears mr-1"></i> Aksi
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($registrations as $index => $register)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-2 font-medium text-gray-900">
                                {{ $index + 1 }}
                            </td>
                            <td class="px-4 py-2 font-medium text-gray-900">
                                {{ optional($register->user)->name ?? $register->name ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-gray-700">
                                {{ optional($register->user)->email ?? $register->email ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-gray-700 whitespace-nowrap">
                                {{ isset($register->registered_at)
                                    ? $register->registered_at->format('d M Y, H:i')
                                    : '-' }}
                            </td>
                            <td class="px-4 py-2 flex flex-col sm:flex-row gap-2 justify-center text-sm">
                                {{-- Form Status --}}
                                <form action="{{ route('admin.registration.change-status', $register->id) }}" method="POST"
                                    class="flex items-center gap-2">
                                    @csrf
                                    <select name="status"
                                        class="px-2 py-1 rounded border text-sm focus:ring-2 focus:ring-green-500">
                                        <option value="pending" {{ $register->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ $register->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ $register->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1 text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                        <i class="fa-solid fa-rotate-right"></i> Update
                                    </button>
                                </form>

                                {{-- Hapus --}}
                                <form action="{{ route('admin.registration.admin-destroy', $register->id) }}" method="POST"
                                    onsubmit="return confirm('Hapus pendaftaran ini?')"
                                    class="flex justify-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1 text-white bg-red-600 rounded hover:bg-red-700 transition">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-600 py-6">
                                <i class="fa-solid fa-circle-info mr-1"></i>
                                Belum ada pendaftar untuk event ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
