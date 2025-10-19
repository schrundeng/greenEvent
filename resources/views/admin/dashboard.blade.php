@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Dashboard Admin</h1>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                text: '{{ session('
                success ') }} {{ auth()->check() ? auth()->user()->name : "" }}!',
                confirmButtonColor: '#16a34a',
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
    @endif

    {{-- Statistik Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

            {{-- Tambah Event Baru --}}
            <a href="{{route('admin.create-edit')}}"
                class="flex items-center gap-3 bg-green-50 border border-green-200 hover:bg-green-100 transition rounded-lg p-3">
                <div class="bg-green-600 text-white p-3 rounded">
                    <i class="fa-solid fa-plus"></i>
                </div>
                <div>
                    <p href="{{--route('admin.event-create')--}}" class="font-medium text-green-800">Tambah Event</p>
                    <p class="text-sm text-gray-500">Buat event baru dengan cepat</p>
                </div>
            </a>

            {{-- Kelola Pengguna --}}
            <a href="{{route('admin.user-management')}}"
                class="flex items-center gap-3 bg-blue-50 border border-blue-200 hover:bg-blue-100 transition rounded-lg p-3">
                <div class="bg-blue-600 text-white p-3 rounded">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <p class="font-medium text-blue-800">Kelola Pengguna</p>
                    <p class="text-sm text-gray-500">Lihat dan ubah data user</p>
                </div>
            </a>

            {{-- Event Berlangsung --}}
            <a href="manage/events?search=&category=&status=ongoing"
                class="flex items-center gap-3 bg-yellow-50 border border-yellow-200 hover:bg-yellow-100 transition rounded-lg p-3">
                <div class="bg-yellow-500 text-white p-3 rounded">
                    <i class="fa-solid fa-calendar"></i>
                </div>
                <div>
                    <p class="font-medium text-yellow-800">Event Berlangsung</p>
                    <p class="text-sm text-gray-500">Lihat event yang sedang aktif</p>
                </div>
            </a>

            {{-- Review Pendaftaran --}}
            <a href="{{route('admin.event-management')}}"
                class="flex items-center gap-3 bg-purple-50 border border-purple-200 hover:bg-purple-100 transition rounded-lg p-3">
                <div class="bg-purple-600 text-white p-3 rounded">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div>
                    <p class="font-medium text-purple-800">Manajamen Event</p>
                    <p class="text-sm text-gray-500">Kelola data event</p>
                </div>
            </a>

        </div>
    </div>
    <div class="flex flex-wrap gap-6 mt-2 mb-2">

    {{-- Statistik Status Event (50%) --}}
    <div class="w-full lg:w-2/5 bg-white rounded-lg mr-auto shadow-md p-5 hover:shadow-lg transition">
        <h2 class="text-lg font-bold text-green-700 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-chart-pie text-green-600"></i> Event Status Monitoring
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-2 gap-3">
            <div class="bg-green-50 p-4 rounded-lg shadow hover:shadow-md transition">
                <h2 class="flex items-center gap-2 text-sm font-medium text-gray-600 uppercase">
                    <i class="fa-solid fa-play text-green-600"></i> Ongoing
                </h2>
                <p class="text-3xl font-bold text-green-700 mt-2">{{ $statusCount['ongoing'] ?? 0 }}</p>
            </div>

            <div class="bg-yellow-50 p-4 rounded-lg shadow hover:shadow-md transition">
                <h2 class="flex items-center gap-2 text-sm font-medium text-gray-600 uppercase">
                    <i class="fa-solid fa-hourglass-start text-yellow-600"></i> Coming Soon
                </h2>
                <p class="text-3xl font-bold text-yellow-700 mt-2">{{ $statusCount['coming_soon'] ?? 0 }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow hover:shadow-md transition">
                <h2 class="flex items-center gap-2 text-sm font-medium text-gray-600 uppercase">
                    <i class="fa-solid fa-flag-checkered text-gray-600"></i> Ended
                </h2>
                <p class="text-3xl font-bold text-gray-700 mt-2">{{ $statusCount['ended'] ?? 0 }}</p>
            </div>

            <div class="bg-red-50 p-4 rounded-lg shadow hover:shadow-md transition">
                <h2 class="flex items-center gap-2 text-sm font-medium text-gray-600 uppercase">
                    <i class="fa-solid fa-ban text-red-600"></i> Cancelled
                </h2>
                <p class="text-3xl font-bold text-red-700 mt-2">{{ $statusCount['cancelled'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-3/6 bg-white rounded-lg shadow-md p-3 hover:shadow-lg transition">
        <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-users text-blue-600"></i> User Baru Bergabung
        </h2>

        <ul class="space-y-3">
            @forelse ($latestUsers as $user)
                <li class="flex items-center justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-700 font-medium flex items-center gap-2">
                        <i class="fa-solid fa-user text-gray-500"></i> @ {{ $user->username }}
                    </span>
                    <span class="text-sm text-gray-500">
                        <i class="fa-solid fa-clock text-gray-400"></i> {{ $user->created_at->diffForHumans() }}
                    </span>
                </li>
            @empty
                <li class="text-gray-500 italic flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> Belum ada pengguna baru.
                </li>
            @endforelse
        </ul>
    </div>

</div>


   {{-- Tabel Event --}}
    <div class="shadow mt-6 overflow-x-auto">
        <table id="eventsTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(0)">
                        <i class="fa-solid fa-heading mr-1"></i> Judul
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(1)">
                        <i class="fa-solid fa-layer-group mr-1"></i> Kategori
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(2)">
                        <i class="fa-solid fa-calendar mr-1"></i> Tanggal
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(3)">
                        <i class="fa-solid fa-location-dot mr-1"></i> Lokasi
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(4)">
                        <i class="fa-solid fa-circle-check mr-1"></i> Status
                    </th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">
                        <i class="fa-solid fa-gears"></i> Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($events as $event)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $event->title }}</td>
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $event->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $event->start_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $event->location }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded 
                             {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('events.detail.show', $event->id) }}"
                            class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                            <i class="fa-solid fa-eye"></i> Detail
                        </a>
                        <a href="{{ route('admin.event-show-registers', $event->id) }}"
                            class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            <i class="fa-solid fa-user"></i> Pendaftar
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-6">
                        Belum ada event yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection