<h1 class="text-3xl font-bold text-green-700 mb-6">Dashboard Admin</h1>

{{-- @extends('admin.layout') --}}

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
            <h2 class="text-sm font-medium text-gray-500 uppercase">Kategori</h2>
            <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalCategories ?? 0 }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-sm font-medium text-gray-500 uppercase">Pendaftaran</h2>
            <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalRegistrations ?? 0 }}</p>
        </div>
    </div>

    {{-- Daftar Event Terbaru --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-green-700">Event Terbaru</h2>
            <a href="" class="text-green-600 hover:text-green-800 text-sm font-medium">Lihat Semua</a>
        </div>

        {{-- @if($latestEvents->isEmpty())
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
                            <th class="px-4 py-2 text-sm font-semibold text-gray-700 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($latestEvents as $event)
                        <tr class="border-b hover:bg-green-50">
                            <td class="px-4 py-2">{{ $event->title }}</td>
                            <td class="px-4 py-2">{{ $event->category->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $event->start_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <span class="px-2 py-1 text-xs rounded 
                                    {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($event->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-right">
                                <a href="{{ route('admin.events.show', $event->id) }}" 
                                   class="text-green-600 hover:text-green-800 font-medium text-sm">
                                   Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif --}}
    </div>
</div>
@endsection
