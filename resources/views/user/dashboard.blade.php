@extends('user.layout')
@section('content')
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
<h1 class="text-2xl font-bold text-green-700 mb-4">
    Dashboard
</h1>
<div class="flex flex-col md:flex-row gap-6">
    {{-- Peta --}}
    <div class="md:w-3/5 w-full h-[600px] rounded-lg shadow-md">
        <div id="map" class="w-full h-full rounded-lg"></div>
    </div>
    {{-- Sidebar Event --}}
    <div class="md:w-2/5 w-full space-y-4">
        {{-- Filter & Search --}}
        <form method="GET" action="{{ route('user.dashboard') }}">
            <input type="text" name="search" placeholder="Cari event..."
                value="{{ request('search') }}"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-2">
            <select name="category" onchange="this.form.submit()"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </form>
        <h2 class="text-xl font-semibold text-green-700 mb-2">Event Terbaru</h2>
        <div class="grid gap-6 overflow-y-auto max-h-[440px]">
            {{-- Grid 2 Kolom --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($events as $event)
                {{-- Sembunyikan event yang sudah berakhir --}}
                @if (!in_array($event->status, ['ended', 'draft']))
                <div
                    class="bg-white rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1 p-4 flex flex-col">
                    {{-- Poster Event --}}
                    <img src="{{ asset('storage/' . $event->poster) }}"
                        alt="{{ $event->title }}"
                        class="rounded-lg mb-3 w-full h-48 object-cover">
                    {{-- Info Event --}}
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $event->title }}</h3>
                        <p class="text-gray-600 text-sm mt-1">
                            📅 {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        </p>
                        <p class="text-gray-600 text-sm">📍 {{ $event->location }}</p>
                        {{-- Status Event --}}
                        <div class="mt-3">
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
                            <span class="text-xs font-medium px-2 py-1 rounded-full
                                {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
                                {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                            </span>
                        </div>
                    </div>
                    {{-- Tombol Detail --}}
                    <div class="mt-4">
                        <a href="{{ route('events.detail.show', $event->id) }}"
                            class="block w-full text-center px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                            Detail
                        </a>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
            {{-- Leaflet Map Script --}}
            <script>
                // Inisialisasi peta
                const map = L.map('map').setView([-7.9606, 112.6365], 12);
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
                    });
                const events = @json($events);
                events.forEach(event => {
                    if (event.latitude && event.longitude) {
                        const marker = L.marker([event.longitude, event.latitude]).addTo(map);
                        marker.bindPopup(`
            <div>
                <strong>${event.title}</strong><br>
                ${event.location}<br>
                <a href="/events/${event.slug}" class="text-green-600 underline">Lihat Detail</a>
            </div>
        `);
                    }
                });
            </script>
            @endsection