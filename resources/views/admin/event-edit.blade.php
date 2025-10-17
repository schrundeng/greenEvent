@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Edit Event</h1>

    <form action="{{ route('admin.event-update', $id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block font-semibold text-gray-700 mb-2">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        {{-- Deskripsi Event --}}
        <div>
            <label for="description" class="block font-semibold text-gray-700 mb-2">Deskripsi</label>
            <textarea id="description" name="description" rows="5"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none"
                      required>{{ old('description', $event->description) }}</textarea>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block font-semibold text-gray-700 mb-2">Lokasi</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        {{-- Koordinat --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="lat" class="block font-semibold text-gray-700 mb-2">Latitude</label>
                <input type="text" id="lat" name="lat" value="{{ old('lat', $event->lat) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
            <div>
                <label for="long" class="block font-semibold text-gray-700 mb-2">Longitude</label>
                <input type="text" id="long" name="long" value="{{ old('long', $event->long) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            </div>
        </div>

        {{-- Kategori --}}
        <div>
            <label for="category_id" class="block font-semibold text-gray-700 mb-2">Kategori</label>
            <select id="category_id" name="category_id"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block font-semibold text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" 
                       value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                       required>
            </div>
            <div>
                <label for="end_date" class="block font-semibold text-gray-700 mb-2">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" 
                       value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d') : '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none" 
                       required>
            </div>
        </div>

        {{-- Poster --}}
        <div>
            <label for="poster" class="block font-semibold text-gray-700 mb-2">Poster Event</label>
            <input type="file" id="poster" name="poster"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:outline-none">
            @if($event->poster)
                <p class="mt-2 text-sm text-gray-500">Poster saat ini:</p>
                <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->title }}" class="w-40 mt-2 rounded shadow">
            @endif
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-4">
            <a href="{{route('admin.event-management', $id) }}" 
               class="px-4 py-2 border border-gray-400 text-gray-600 rounded hover:bg-gray-100">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
