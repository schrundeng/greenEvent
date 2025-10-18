@extends('layout')

@section('content')
<section class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold text-green-700 mb-3">Tentang <span class="text-gray-800">Green Event</span></h1>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Membangun kesadaran, menumbuhkan aksi. Green Event adalah platform yang membantu komunitas dan individu
                menemukan, mengelola, dan berpartisipasi dalam kegiatan bertema lingkungan secara lebih mudah.
            </p>
        </div>

        {{-- Section 1: Misi --}}
        <div class="bg-white p-8 rounded-xl shadow-sm mb-8">
            <h2 class="text-2xl font-semibold text-green-700 mb-4">🌱 Misi Kami</h2>
            <p class="text-gray-700 leading-relaxed">
                Kami percaya bahwa setiap langkah kecil untuk menjaga bumi akan berarti besar jika dilakukan bersama.
                Melalui Green Event, kami ingin:
            </p>
            <ul class="list-disc list-inside text-gray-700 mt-3 space-y-1">
                <li>Mendorong kolaborasi antar komunitas hijau.</li>
                <li>Mempermudah publik menemukan acara bertema lingkungan.</li>
                <li>Mendukung penyelenggara untuk mengelola acara dengan efisien dan ramah lingkungan.</li>
            </ul>
        </div>

        {{-- Section 2: Fitur --}}
        <div class="bg-white p-8 rounded-xl shadow-sm mb-8">
            <h2 class="text-2xl font-semibold text-green-700 mb-4">💡 Apa yang Kami Tawarkan</h2>
            <p class="text-gray-700 leading-relaxed mb-3">
                Green Event tidak hanya sekadar daftar acara. Kami hadir untuk memudahkan semua pihak yang peduli lingkungan.
            </p>
            <div class="grid md:grid-cols-2 gap-6 text-gray-700">
                <div>
                    <h3 class="font-semibold text-lg mb-1">🎟️ Temukan Event</h3>
                    <p class="text-sm">Jelajahi berbagai acara bertema lingkungan dari seluruh daerah — mulai dari penanaman pohon hingga workshop daur ulang.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">📅 Kelola Event</h3>
                    <p class="text-sm">Admin dan penyelenggara dapat mengelola jadwal, peserta, dan data acara dengan efisien melalui dashboard kami.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">👥 Ikuti dan Dukung</h3>
                    <p class="text-sm">Daftar sebagai peserta, bagikan acara favoritmu, dan bantu sebarkan semangat hijau ke lebih banyak orang.</p>
                </div>
                <div>
                    <h3 class="font-semibold text-lg mb-1">🌏 Dampak Nyata</h3>
                    <p class="text-sm">Setiap event yang berhasil diselenggarakan adalah kontribusi nyata untuk bumi yang lebih baik.</p>
                </div>
            </div>
        </div>

        {{-- Section 3: Call to Action --}}
        <div class="bg-green-700 text-white p-8 rounded-xl shadow-md text-center">
            <h2 class="text-2xl font-bold mb-2">Bersama, Kita Hijaukan Dunia 🌿</h2>
            <p class="text-green-100 mb-10">Mulai langkah kecilmu hari ini. Temukan acara lingkungan, ikuti, dan sebarkan kebaikan.</p>
            <a href="/" class="bg-white text-green-700 font-semibold px-6 py-3 rounded-lg shadow hover:bg-green-100 transition">
                Jelajahi Event Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
