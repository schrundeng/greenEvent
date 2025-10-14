@extends('user.layout')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    {{-- Judul Event --}}
    <h1 class="text-3xl font-bold text-green-700 mb-4">{{ $event->title }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        {{-- Poster --}}
        <div class="md:w-2/5 w-full rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $event->poster) }}"
                alt="{{ $event->title }}" class="w-full h-auto">
        </div>

        {{-- Info Event --}}
        <div class="md:w-3/5 w-full space-y-4">
            <div class="text-gray-700">
                <p class="mb-1"><strong>📅 Tanggal:</strong> {{ $event->start_date }} - {{ $event->end_date }} </p>
                <p class="mb-1"><strong>🕒 Waktu:</strong> {{ $event->time }} </p>
                <p class="mb-1"><strong>📍 Lokasi:</strong> {{ $event->location }}</p>
                <p class="mb-1"><strong>📂 Kategori:</strong> {{ $event->category->name }}</p>
                <p class="mb-1"><strong>Status:</strong> {{ $event->status }}</p>
            </div>

            <div class="mt-4">
                <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
                <p class="text-gray-600">{{ $event->description }} </p>
            </div>

            {{-- Tombol Daftar --}}
            <a href="route('user.events.register', $event->slug)"
                class="inline-block mt-4 px-6 py-3 bg-green-600 text-white font-medium rounded hover:bg-green-700">
                Daftar Event
            </a>
        </div>
    </div>

    {{-- Peta Lokasi --}}
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-green-700 mb-4">Lokasi Event</h2>
        <div id="map" class="w-full h-[400px] rounded-lg shadow-md"></div>
    </div>
</div>

// {{-- Leaflet Map Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Initialize map with event coordinates using Blade syntax
            const latitude = {!! $event->latitude ?? 'null' !!};
            const longitude = {!! $event->longitude ?? 'null' !!};
            
            if (!latitude || !longitude) {
                throw new Error('Location coordinates are not available');
            }

            // Create map instance
            const map = L.map('map').setView([latitude, longitude], 14);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            // Add marker with popup - using proper Blade syntax for JSON encoding
            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup(`
                <div class="map-popup">
                    <strong>{!! json_encode($event->title) !!}</strong><br>
                    {!! json_encode($event->location) !!}
                </div>
            `).openPopup();

        } catch (error) {
            console.error('Map initialization failed:', error);
            document.getElementById('map').innerHTML = 
                '<div class="p-4 text-red-500">Failed to load map. Please try again later.</div>';
        }
    });
</script>
@endsection