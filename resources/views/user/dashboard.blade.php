@extends('user.layout')

@section('content')
    <h1 class="text-2xl font-bold text-green-700 mb-4">Peta Event</h1>

    {{-- Peta --}}
    <div id="map" class="w-full h-[500px] rounded-lg shadow-md mb-8"></div>

    <h2 class="text-xl font-semibold text-green-700 mb-4">Event Terbaru</h2>

    {{-- Daftar Event --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{--  @foreach ($events as $event)
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-4">
                <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->title }}" class="rounded mb-3">
                <h3 class="font-semibold text-lg">{{ $event->title }}</h3>
                <p class="text-gray-600 text-sm mb-1">📅 {{ $event->date }}</p>
                <p class="text-gray-600 text-sm mb-1">📍 {{ $event->location }}</p>
                <a href="{{ route('user.events.show', $event->slug) }}" 
                   class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                   Detail
                </a>
            </div>
        @endforeach --}}
    </div>

    {{-- Leaflet Map Script --}}
    <script>
        const map = L.map('map').setView([-7.9818, 112.6265], 12); // Contoh: Padang
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);
{{--
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
        }); --}}
    </script>
@endsection
