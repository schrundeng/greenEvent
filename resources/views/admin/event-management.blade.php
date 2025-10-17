@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Manajemen Event</h1>
        <a href="{{route('admin.create-edit')}} " 
           class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
           + Tambah Event
        </a>
    </div>

    {{-- Filter & Pencarian --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form method="GET" action="{{ route('admin.event-management') }}" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari event..." 
                   class="px-3 py-2 border rounded w-64 focus:outline-none focus:ring focus:ring-green-200">

            <select name="category" class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-green-200">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <select name="status" class="px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-green-200">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>

            <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Filter
            </button>
        </form>
    </div>

    {{-- Tabel Event --}}
    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead class="bg-green-50">
                <tr>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Judul</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Kategori</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Tanggal</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Lokasi</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-4 py-3 text-sm font-semibold text-gray-700 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($events as $event)
                <tr class="border-b hover:bg-green-50">
                    <td class="px-4 py-2">{{ $event->title }}</td>
                    <td class="px-4 py-2">{{ $event->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm">{{ $event->start_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-sm">{{ $event->location }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded 
                            {{ $event->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('events.detail.show', $event->id) }}" 
                           class="text-green-600 hover:text-green-800 font-medium text-sm">Lihat</a>
                        <a href="{{ route('admin.event-edit', $event->id) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">Edit</a>
                        <form action="{{-- route('admin.events.destroy', $event->id) --}}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus event ini?')" 
                                    class="text-red-600 hover:text-red-800 font-medium text-sm">
                                Hapus
                            </button>
                        </form>
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

    {{-- Pagination --}}
    <div class="mt-6">
        {{-- $events->links() --}}
    </div>
</div>
@endsection
