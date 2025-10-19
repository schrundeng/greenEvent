@extends('user.layout')
@section('content')

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Login Berhasil!',
            text: '{{ session('success') }} {{ auth()->check() ? auth()->user()->name : "" }}!',
            confirmButtonColor: '#16a34a',
            timer: 2500,
            showConfirmButton: false
        });
    });
</script>
@endif

<h1 class="text-2xl font-bold text-green-700 mb-4 flex items-center gap-2">
    <i class="fa-solid fa-gauge-high text-green-600"></i>
    Dashboard
</h1>

{{-- Kontainer Utama --}}
<div class="flex flex-col lg:flex-row gap-6">

    {{-- Peta --}}
    <div class="w-full lg:w-3/5 h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] rounded-lg shadow-md order-2 lg:order-1">
        <div id="map" class="w-full h-full rounded-lg"></div>
    </div>

    {{-- Sidebar Event --}}
    <div class="w-full lg:w-2/5 space-y-4 order-1 lg:order-2">
        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('user.dashboard') }}" class="flex flex-col sm:flex-row sm:items-center sm:gap-2">
            <input 
                type="text" 
                name="search" 
                placeholder="🔍 Cari event..."
                value="{{ request('search') }}"
                class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-2 sm:mb-0">
            
            <select 
                name="category" 
                onchange="this.form.submit()"
                class="w-full sm:w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option 
                        value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <h2 class="text-xl font-semibold text-green-700 flex items-center gap-2">
            <i class="fa-solid fa-calendar-days"></i>
            Event Terbaru
        </h2>

        {{-- Daftar Event --}}
        <div class="grid gap-6 overflow-y-auto max-h-[480px] pr-2">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-4">
                @foreach ($events as $event)
                    @if (!in_array($event->status, ['ended', 'draft']))
                        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1 p-4 flex flex-col">
                            {{-- Poster Event --}}
                            <img 
                                src="{{ asset('storage/' . $event->poster) }}" 
                                alt="{{ $event->title }}" 
                                class="rounded-lg mb-3 w-full h-40 sm:h-48 object-cover lazy">

                            {{-- Info Event --}}
                            <div class="flex-1">
                                <h3 class="font-semibold text-lg text-gray-800 line-clamp-2">{{ $event->title }}</h3>
                                <p class="text-gray-600 text-sm mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-calendar text-green-600"></i>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                </p>
                                <p class="text-gray-600 text-sm flex items-center gap-1">
                                    <i class="fa-solid fa-location-dot text-green-600"></i>
                                    {{ $event->location }}
                                </p>

                                {{-- Status Event --}}
                                @php
                                    $statusLabels = [
                                        'ongoing' => ['label' => 'Ongoing', 'icon' => 'fa-play-circle'],
                                        'coming_soon' => ['label' => 'Coming Soon', 'icon' => 'fa-hourglass-half'],
                                        'cancelled' => ['label' => 'Cancelled', 'icon' => 'fa-circle-xmark'],
                                        'ended' => ['label' => 'Ended', 'icon' => 'fa-flag-checkered'],
                                    ];
                                    $statusColors = [
                                        'ongoing' => 'bg-green-100 text-green-700',
                                        'coming_soon' => 'bg-yellow-100 text-yellow-700',
                                        'cancelled' => 'bg-red-100 text-red-700',
                                        'ended' => 'bg-gray-200 text-gray-600',
                                    ];
                                    $status = $event->status;
                                @endphp
                                <span class="text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1 w-fit mt-3 {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-500' }}">
                                    <i class="fa-solid {{ $statusLabels[$status]['icon'] ?? 'fa-circle-question' }}"></i>
                                    {{ $statusLabels[$status]['label'] ?? ucfirst($status) }}
                                </span>
                            </div>

                            {{-- Tombol Detail --}}
                            <div class="mt-4">
                                <a href="{{ route('events.detail.show', $event->id) }}"
                                    class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition text-sm font-medium">
                                    <i class="fa-solid fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- Leaflet Map Script --}}
<script>
    const map = L.map('map').setView([-7.9606, 112.6365], 12);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
    }).addTo(map);

    fetch('/malang.geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: {
                    color: '#00ff6eff',
                    weight: 2,
                    fillOpacity: 0.1
                }
            }).addTo(map);
        });

    const events = @json($events);
    events.forEach(event => {
        if ((event.status === 'ongoing' || event.status === 'coming_soon') &&
            event.latitude && event.longitude) {

            const marker = L.marker([event.latitude, event.longitude]).addTo(map);
            const popupContent = `
                <div class="popup-card font-sans">
                    <img src="/storage/${event.poster}" alt="${event.title}" class="popup-image">
                    <div class="popup-body">
                        <h3 class="popup-title">${event.title}</h3>
                        <p class="popup-location">${event.location}</p>
                        <p class="popup-date">${new Date(event.start_date).toLocaleDateString('id-ID', {
                            day: 'numeric', month: 'short', year: 'numeric'
                        })}</p>
                        <a href="/event-detail/${event.slug}" class="popup-btn text-white">Lihat Detail</a>
                    </div>
                </div>
            `;
            marker.bindPopup(popupContent);
        }
    });
</script>

<style>
.leaflet-container a {
    color: white;
}
.popup-card {
    width: 220px;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    transition: transform 0.2s ease;
}
.popup-card:hover { transform: translateY(-3px); }
.popup-image { width: 100%; height: 100px; object-fit: cover; }
.popup-body { padding: 10px 12px; }
.popup-title { font-weight: 600; color: #14532d; font-size: 14px; margin-bottom: 4px; }
.popup-location, .popup-date { font-size: 12px; color: #4b5563; }
.popup-btn {
    display: inline-block;
    background-color: #16a34a;
    color: white;
    font-size: 12px;
    text-align: center;
    padding: 6px 10px;
    border-radius: 6px;
    text-decoration: none;
    transition: background-color 0.2s ease;
}
.popup-btn:hover { background-color: #15803d; }
</style>

@endsection
