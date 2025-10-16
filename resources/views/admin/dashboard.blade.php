@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Dashboard Admin</h1>

    {{-- Statistik Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-sm font-medium text-gray-500 uppercase">Total Event</h2>
            <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalEvents ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-sm font-medium text-gray-500 uppercase">Total Pengguna</h2>
            <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalUsers ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-sm font-medium text-gray-500 uppercase">Pendaftaran</h2>
            <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalRegistrations ?? 0 }}</p>
        </div>
    </div>
    
    {{-- Quick Actions --}}
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h2 class="text-xl font-semibold text-green-700 mb-4">Quick Actions</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        {{-- Tambah Event Baru --}}
        <a href="{{--route('admin.events.create')--}}"
           class="flex items-center gap-3 bg-green-50 border border-green-200 hover:bg-green-100 transition rounded-lg p-4">
            <div class="bg-green-600 text-white p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div>
                <p href="{{ route('admin.event-create') }}" class="font-medium text-green-800">Tambah Event</p>
                <p class="text-sm text-gray-500">Buat event baru dengan cepat</p>
            </div>
        </a>

        {{-- Kelola Pengguna --}}
        <a href="{{--route('admin.users.index'--}}"
           class="flex items-center gap-3 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition rounded-lg p-4">
            <div class="bg-blue-600 text-white p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 11a4 4 0 110-8 4 4 0 010 8zm6 9H3v-2a4 4 0 013-3.87" />
                </svg>
            </div>
            <div>
                <p class="font-medium text-blue-800">Kelola Pengguna</p>
                <p class="text-sm text-gray-500">Lihat dan ubah data user</p>
            </div>
        </a>

        {{-- Event Berlangsung --}}
        <a href="{{--route('admin.events.index', ['status' => 'ongoing'--}}"
           class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 hover:bg-yellow-100 transition rounded-lg p-4">
            <div class="bg-yellow-500 text-white p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M13 16h-1v-4h-1m0-4h.01M12 8v4l3 3" />
                </svg>
            </div>
            <div>
                <p class="font-medium text-yellow-800">Event Berlangsung</p>
                <p class="text-sm text-gray-500">Lihat event yang sedang aktif</p>
            </div>
        </a>

        {{-- Review Pendaftaran --}}
        <a href="{{--route('admin.registrations.index')--}}"
           class="flex items-center gap-3 bg-purple-50 border border-purple-200 hover:bg-purple-100 transition rounded-lg p-4">
            <div class="bg-purple-600 text-white p-2 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <div>
                <p class="font-medium text-purple-800">Review Pendaftaran</p>
                <p class="text-sm text-gray-500">Kelola data peserta event</p>
            </div>
        </a>

    </div>
</div>


    {{-- Daftar Event Terbaru --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-green-700">Event Terbaru</h2>
            <a href="" class="text-green-600 hover:text-green-800 text-sm font-medium">Lihat Semua</a>
        </div>

        @if($events->isEmpty())
            <p class="text-gray-600">Belum ada event yang dibuat.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-green-50 border-b">
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700">Judul</th>
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700">Kategori</th>
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700">Tanggal</th>
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-right">Detail Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        @php
                            $statusColor = match($event->status) {
                                'ongoing' => 'bg-green-100 text-green-700',
                                'coming_soon' => 'bg-yellow-100 text-yellow-700',
                                'ended' => 'bg-gray-200 text-gray-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                                default => 'bg-gray-100 text-gray-600'
                            };
                        @endphp

                        <tr class="border-b hover:bg-green-50">
                            <td class="px-4 py-2">{{ $event->title }}</td>
                            <td class="px-4 py-2">{{ $event->category->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $event->start_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('event.detail.show', $event->id) }}"
                                   class="text-green-600 hover:text-green-800 font-medium text-sm">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@endsection
