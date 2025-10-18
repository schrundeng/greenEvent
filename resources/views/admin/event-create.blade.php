@extends('admin.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-green-700">Tambah Event Baru</h1>
        <a href="{{ route('admin.event-management') }}" 
           class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded transition">
            ← Kembali
        </a>
    </div>

    <form action="{{ route('admin.events-store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 rounded-lg shadow-md space-y-6">
        @csrf

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Event</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
        </div>

        {{-- Organizer + Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="organizer" class="block text-sm font-medium text-gray-700 mb-1">Organizer</label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" required>
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category_id" id="category_id" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                      placeholder="Tulis deskripsi event...">{{ old('description') }}</textarea>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
            <input type="text" id="location" name="location" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
        </div>

        {{-- Map --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Lokasi di Peta</label>
            <div id="map" style="height: 300px; border-radius: 8px;"></div>
            <p class="text-xs text-gray-500 mt-1">Gunakan <strong>Ctrl + Scroll</strong> untuk zoom map.</p>
        </div>

        {{-- Koordinat --}}
        <div class="grid grid-cols-2 gap-4 mt-3">
            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" readonly>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" readonly>
            </div>
        </div>

        {{-- Tanggal Mulai + Selesai --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
        </div>

        {{-- Status + Poster --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
                    <option value="draft">Draft</option>
                    <option value="coming_soon">Coming Soon</option>
                </select>
            </div>
            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Poster (mendukung format PNG/JPG/JPEG)</label>
                <input type="file" id="poster" name="poster" accept=".png,.jpg,.jpeg"
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            <div>
                <label for="poster" class="block text-sm font-medium text-gray-700 mb-1">Preview Poster</label>
                <img id="posterPreview" src="#" alt="Preview Poster" 
                     class="hidden mt-3 rounded-lg shadow-md w-48 h-64 object-cover">
</div>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end space-x-3 pt-4 border-t">
            <a href="{{ route('admin.event-management') }}" 
               class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Simpan Event
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

    const defaultLat = -7.960807;
    const defaultLng = 112.637272;

    const map = L.map('map', {
        center: [defaultLat, defaultLng],
        zoom: 13,
        scrollWheelZoom: false // disable scroll zoom by default
    });

    // Aktifkan zoom hanya jika Ctrl ditekan
    map.getContainer().addEventListener('wheel', function (e) {
        if (e.ctrlKey) {
            map.scrollWheelZoom.enable();
        } else {
            map.scrollWheelZoom.disable();
        }
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19
    }).addTo(map);

    let marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    marker.on('moveend', function (e) {
        const { lat, lng } = e.target.getLatLng();
        latInput.value = lat.toFixed(6);
        longInput.value = lng.toFixed(6);
    });

    map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        marker.setLatLng([lat, lng]);
        latInput.value = lat.toFixed(6);
        longInput.value = lng.toFixed(6);
    });

    // Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (pos) => {
                const { latitude, longitude } = pos.coords;
                map.setView([latitude, longitude], 15);
                marker.setLatLng([latitude, longitude]);
                latInput.value = latitude.toFixed(6);
                longInput.value = longitude.toFixed(6);
            },
            () => {
                latInput.value = defaultLat;
                longInput.value = defaultLng;
            }
        );
    }

    // Tambah area geojson jika tersedia
    fetch('/../malang.geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, { style: { color: '#00ff6e', weight: 2, fillOpacity: 0.1 } }).addTo(map);
        });

    // Preview poster
    const posterInput = document.getElementById('poster');
    const preview = document.getElementById('posterPreview');

    posterInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const validTypes = ['image/png', 'image/jpg', 'image/jpeg'];
            if (!validTypes.includes(file.type)) {
                alert('Format file tidak valid. Hanya mendukung PNG, JPG, dan JPEG.');
                posterInput.value = '';
                preview.classList.add('hidden');
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    });
});
</script>
@endsection
