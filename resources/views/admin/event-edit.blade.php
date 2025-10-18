@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-gray-100">
    <h1 class="text-2xl font-bold text-green-700 mb-6 flex items-center gap-2">
        Edit Event
    </h1>

    <form action="{{ route('admin.event-update', $event) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('POST')

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        {{-- Organizer & Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="organizer" class="block text-sm font-semibold text-gray-700 mb-1">Organizer</label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer', $event->organizer) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>

            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1">Kategori</label>
                <select id="category_id" name="category_id"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $event->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none"
                required>{{ old('description', $event->description) }}</textarea>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
        </div>

        {{-- Map --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih Lokasi di Peta</label>
            <div id="map" style="height: 300px; border-radius: 8px;"></div>
            <p class="text-xs text-gray-500 mt-2">Gunakan <strong>Ctrl + Scroll</strong> untuk zoom.</p>
        </div>

        {{-- Koordinat --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-1">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $event->latitude) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" readonly>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-1">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $event->longitude) }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" readonly>
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date"
                    value="{{ old('start_date', $event->start_date ? $event->start_date->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date"
                    value="{{ old('end_date', $event->end_date ? $event->end_date->format('Y-m-d') : '') }}"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none" required>
            </div>
        </div>

        {{-- Status & Poster --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                <select id="status" name="status"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                    <option value="draft" {{ $event->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="coming_soon" {{ $event->status == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                    <option value="ongoing" {{ $event->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="ended" {{ $event->status == 'ended' ? 'selected' : '' }}>Ended</option>
                </select>
            </div>

            <div>
                <label for="poster" class="block text-sm font-semibold text-gray-700 mb-1">Poster (JPG, JPEG, PNG)</label>
                <input type="file" id="poster" name="poster" accept=".jpg,.jpeg,.png"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-green-500 focus:outline-none">
                <div id="previewContainer" class="mt-3">
                    @if($event->poster)
                    <img src="{{ asset('storage/' . $event->poster) }}" class="w-40 rounded-lg shadow-md" alt="Current Poster">
                    @endif
                </div>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('admin.event-management') }}"
                class="px-4 py-2 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 transition">← Kembali</a>
            <button type="submit"
                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>

{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const latInput = document.getElementById('latitude');
    const longInput = document.getElementById('longitude');

    // --- Inisialisasi peta (ingat Leaflet: [lat, lng]) ---
    const map = L.map('map', { scrollWheelZoom: false })
        .setView([{{ $event->longitude ?? 112.637272 }}, {{ $event->latitude ?? -7.960807 }}], 13);

    // --- Aktifkan zoom hanya jika Ctrl ditekan ---
    map.getContainer().addEventListener('wheel', (e) => {
        if (e.ctrlKey) {
            map.scrollWheelZoom.enable();
        } else {
            map.scrollWheelZoom.disable();
        }
    });

    // --- Tile layer OSM ---
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    // --- Marker awal ---
    let marker = L.marker(
        [{{ $event->longitude ?? 112.637272 }}, {{ $event->latitude ?? -7.960807 }},],
        { draggable: true }
    ).addTo(map);

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
    // --- Saat marker dipindah ---
    marker.on('moveend', (e) => {
        const { lat, lng } = e.target.getLatLng();
        // ⚠️ Simpan kebalik: latitude = lng, longitude = lat
        latInput.value = lng.toFixed(6);
        longInput.value = lat.toFixed(6);
    });

    // --- Saat klik peta ---
    map.on('click', (e) => {
        const { lat, lng } = e.latlng;
        marker.setLatLng([lat, lng]);
        // ⚠️ Simpan kebalik: latitude = lng, longitude = lat
        latInput.value = lng.toFixed(6);
        longInput.value = lat.toFixed(6);
    });

    // --- Preview poster ---
    document.getElementById('poster').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file && /\.(jpg|jpeg|png)$/i.test(file.name)) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('previewContainer').innerHTML =
                    `<img src="${e.target.result}" class="w-40 rounded-lg shadow-md mt-2" alt="Preview">`;
            };
            reader.readAsDataURL(file);
        } else {
            alert('Format file tidak valid. Hanya JPG, JPEG, atau PNG.');
            event.target.value = '';
        }
    });
});
</script>

@endsection
