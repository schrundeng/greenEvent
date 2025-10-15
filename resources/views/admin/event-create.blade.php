@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-green-700 mb-6">Tambah Event Baru</h1>

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md space-y-6">
        @csrf

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400" required>
        </div>

        {{-- Kategori --}}
        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="category_id" id="category_id" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('description') }}</textarea>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" id="location" name="location" value="{{ old('location') }}"
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- Koordinat --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
        </div>

        {{-- Tanggal Mulai & Selesai --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                       class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" 
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        {{-- Poster --}}
        <div>
            <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster</label>
            <input type="file" id="poster" name="poster"
                   class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.events.index') }}" 
               class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Simpan Event
            </button>
        </div>
    </form>
</div>
@endsection
