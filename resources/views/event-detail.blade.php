@extends('layout')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-4">

    {{-- Judul Event --}}
    <h1 class="text-3xl font-bold text-green-700 mb-4">{{ $event->title }}</h1>

    <div class="flex flex-col md:flex-row gap-8">
        {{-- Poster --}}
        <div class="md:w-2/5 w-full rounded-lg shadow-md overflow-hidden">
            <img src="{{ asset('storage/' . $event->poster) }}"
                alt="{{ $event->title }}"
                class="rounded-lg shadow-md">
        </div>

        {{-- Info Event --}}
        <div class="md:w-3/5 w-full space-y-4">
            <div class="bg-white shadow-lg rounded-2xl p-6 border border-gray-100">
                {{-- Header Event --}}
                <div class="flex justify-between items-start border-b border-gray-200 pb-4 mb-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h1>
                    </div>

                    {{-- Status badge --}}
                    @php
    $statusLabels = [
        'ongoing' => 'Ongoing',
        'coming_soon' => 'Coming Soon',
        'cancelled' => 'Cancelled',
        'ended' => 'Ended',
    ];

    $statusColors = [
        'ongoing' => 'bg-green-100 text-green-700',
        'coming_soon' => 'bg-yellow-100 text-yellow-700',
        'cancelled' => 'bg-red-100 text-red-700',
        'ended' => 'bg-gray-200 text-gray-600',
    ];
@endphp

<span class="px-3 py-1 text-sm font-semibold rounded-full
    {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
    {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
</span>

                </div>

                {{-- Grid Info --}}
                {{-- Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
                    {{-- Kolom Kiri --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="text-green-600 text-lg">📅</span>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('d M Y') }}
                                    –
                                    {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-blue-600 text-lg">🕒</span>
                            <div>
                                <p class="text-sm text-gray-500">Waktu</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('H:i') }} –
                                    {{ \Carbon\Carbon::parse($event->end_date)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-red-600 text-lg">📍</span>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-medium">{{ $event->location }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="text-yellow-600 text-lg">📂</span>
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-medium">{{ $event->category->name }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-purple-600 text-lg">👥</span>
                            <div>
                                <p class="text-sm text-gray-500">Peserta Terdaftar</p>
                                <p class="font-medium">{{ $event->participants_count ?? 0 }} orang</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="text-teal-600 text-lg">🏢</span>
                            <div>
                                <p class="text-sm text-gray-500">Penyelenggara</p>
                                <p class="font-medium">{{ $event->organizer ?? 'Panitia Event' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

            {{-- Tombol Daftar --}}
            <a href="{{ route('user.event-register', $event->slug ?? $event->id) }}"
                class="inline-block mt-4 px-6 py-3 bg-green-600 text-white font-medium rounded hover:bg-green-700">
                Daftar Event
            </a>

                {{-- Deskripsi --}}
                <div class="mt-8 bg-gray-50 p-6 rounded-lg border border-gray-100 shadow-sm">
                    <h2 class="text-xl font-semibold mb-3 text-gray-800 flex items-center gap-2">
                        📝 <span>Deskripsi Acara</span>
                    </h2>
                    <div class="text-gray-700 leading-relaxed max-h-40 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                        {{ $event->description }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Peta Lokasi --}}
    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-green-700 mb-4">Lokasi Event</h2>
        <div id="map" class="w-full h-[400px] rounded-lg shadow-md"></div>
    </div>
</div>

{{-- Leaflet Map Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Initialize map with event coordinates using Blade syntax
            const latitude = {{$latitude ?? 'null'}};
            const longitude = {{ $longitude ?? 'null'}};

            if (!latitude || !longitude) {
                throw new Error('Location coordinates are not available');
            }

            // Create map instance
            const map = L.map('map').setView([longitude, latitude], 15);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19
            }).addTo(map);

            fetch('/../malang.geojson')
                .then(res => res.json())
                .then(data => {
                    const malangBoundary = L.geoJSON(data, {
                        style: {
                            color: '#00ff6eff', // warna garis
                            weight: 2,
                            fillOpacity: 0.1 // transparansi isi area
                        }
                    }).addTo(map);
                });

            // Add marker with popup
            const marker = L.marker([longitude, latitude]).addTo(map);
            marker.bindPopup(`
                <div>
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