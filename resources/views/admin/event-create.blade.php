@extends('admin.layout')

@section('content')
{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 space-y-3 sm:space-y-0">
        <h1 class="text-3xl font-extrabold text-green-700 flex items-center gap-2">
            <i class="fa-solid fa-calendar-plus"></i> Tambah Event Baru
        </h1>
        <a href="{{ route('admin.event-management') }}" 
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg shadow-sm transition">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.events-store') }}" method="POST" enctype="multipart/form-data" 
          class="bg-white p-6 sm:p-8 rounded-xl shadow-lg border border-gray-100 space-y-6 transition">
        @csrf

        {{-- Judul Event --}}
        <div>
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-pen-to-square text-green-500"></i> Judul Event
            </label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-transparent transition"
                   placeholder="Masukkan judul event..." required>
        </div>

        {{-- Organizer + Kategori --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="organizer" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-user-tie text-green-500"></i> Organizer
                </label>
                <input type="text" id="organizer" name="organizer" value="{{ old('organizer') }}" 
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition" required>
            </div>
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-layer-group text-green-500"></i> Kategori
                </label>
                <select name="category_id" id="category_id" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div>
            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-align-left text-green-500"></i> Deskripsi
            </label>
            <textarea id="description" name="description" rows="4"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition"
                      placeholder="Tulis deskripsi event...">{{ old('description') }}</textarea>
        </div>

        {{-- Lokasi --}}
        <div>
            <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-location-dot text-green-500"></i> Lokasi
            </label>
            <input type="text" id="location" name="location" 
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition">
        </div>

        {{-- Map --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-map-location-dot text-green-500"></i> Pilih Lokasi di Peta
            </label>
            <div id="map" class="w-full h-72 rounded-lg border border-gray-300 shadow-sm"></div>
            <p class="text-xs text-gray-500 mt-2">Gunakan <strong>Ctrl + Scroll</strong> untuk zoom map.</p>
        </div>

        {{-- Koordinat --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="latitude" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-arrow-up text-green-500"></i> Latitude
                </label>
                <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-400 transition" readonly>
            </div>
            <div>
                <label for="longitude" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-arrow-right text-green-500"></i> Longitude
                </label>
                <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-400 transition" readonly>
            </div>
        </div>

        {{-- Tanggal --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-calendar-day text-green-500"></i> Tanggal Mulai
                </label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition">
            </div>
            <div>
                <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-calendar-check text-green-500"></i> Tanggal Selesai
                </label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition">
            </div>
        </div>

        {{-- Status + Poster --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-toggle-on text-green-500"></i> Status
                </label>
                <select name="status" id="status" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                    <option value="draft">Draft</option>
                    <option value="coming_soon">Coming Soon</option>
                </select>
            </div>
            <div>
                <label for="poster" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-solid fa-image text-green-500"></i> Poster (PNG/JPG/JPEG)
                </label>
                <input type="file" id="poster" name="poster" accept=".png,.jpg,.jpeg"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-400 transition file:mr-3 file:py-2 file:px-3 file:rounded file:border-0 file:text-white file:bg-green-600 file:hover:bg-green-700 file:cursor-pointer">
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                <i class="fa-solid fa-eye text-green-500"></i> Preview Poster
            </label>
            <img id="posterPreview" src="#" alt="Preview Poster" 
                 class="hidden mt-2 rounded-lg shadow-md w-48 h-64 object-cover border border-gray-200">
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end flex-wrap gap-3 pt-6 border-t border-gray-200">
            <a href="{{ route('admin.event-management') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-100 transition">
                <i class="fa-solid fa-xmark"></i> Batal
            </a>
            <button type="submit" 
                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Event
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
        scrollWheelZoom: false
    });

    map.getContainer().addEventListener('wheel', function (e) {
        if (e.ctrlKey) map.scrollWheelZoom.enable();
        else map.scrollWheelZoom.disable();
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

    fetch('/../malang.geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, { style: { color: '#00ff6e', weight: 2, fillOpacity: 0.1 } }).addTo(map);
        });

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
