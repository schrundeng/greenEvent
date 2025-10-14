@extends('user.layout')

@section('content')
<h1 class="text-2xl font-bold text-green-700 mb-4">Dashboard</h1>

<div class="flex flex-col md:flex-row gap-6">
    {{-- Peta --}}
    <div class="md:w-3/5 w-full h-[600px] rounded-lg shadow-md">
        <div id="map" class="w-full h-full rounded-lg"></div>
    </div>

    {{-- Sidebar Event --}}
    <div class="md:w-2/5 w-full space-y-4">
        {{-- Filter & Search --}}
        <div class="flex flex-col gap-3 mb-4">
            <input type="text" placeholder="Cari event..."
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">

            <select class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <h2 class="text-xl font-semibold text-green-700 mb-2">Event Terbaru</h2>

        <div class="space-y-4 overflow-y-auto max-h-[540px]">
            {{-- @foreach ($events as $event) --}}
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-4">
                <img src="{{-- asset('storage/' . $event->poster) --}}"
                    alt="{{-- $event->title --}}" class="rounded mb-3">
                <h3 class="font-semibold text-lg">{{-- $event->title --}}Contoh Event</h3>
                <p class="text-gray-600 text-sm mb-1">📅 12/23/3456</p>
                <p class="text-gray-600 text-sm mb-1">📍 Contoh Lokasi</p>
                <a href="#"
                    class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    Detail
                </a>
            </div>
            {{-- @endforeach --}}
        </div>
    </div>
</div>

{{-- Leaflet Map Script --}}
<script>
    // Inisialisasi peta
    const map = L.map('map').setView([-7.9818, 112.6265], 12);

    // Tambahkan tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    // Load GeoJSON boundary Kota Malang
    fetch('/malang.geojson')
        .then(res => res.json())
        .then(data => {
            const malangBoundary = L.geoJSON(data, {
                style: {
                    color: '#00ff6eff', // warna garis
                    weight: 2,
                    fillOpacity: 0.1 // transparansi isi area
                }
            }).addTo(map);

            // Zoom map ke area Kota Malang
            map.fitBounds(malangBoundary.getBounds());
        });

    {
        {
            --
            const events = @json($events);

            events.forEach(event => {
                if (event.lat && event.long) {
                    const marker = L.marker([event.lat, event.long]).addTo(map);
                    marker.bindPopup(`
                    <div>
                        <strong>${event.title}</strong><br>
                        ${event.location}<br>
                        <a href="/events/${event.slug}" class="text-green-600 underline">Lihat Detail</a>
                    </div>
                `);
                }
            });
            --
        }
    }
</script>
@endsection