<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Event Malang</title>
    @vite('resources/css/app.css')
    <link rel="manifest" href="/manifest.json">
</head>
<body class="antialiased">

    <!-- HEADER -->
    <header class="bg-green-500 text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded">
                    GE
                </div>
                <span class="font-semibold">Green Event</span>
            </div>
            <nav class="flex gap-6">
                <a href="#" class="hover:text-gray-200">Beranda</a>
                <a href="#" class="hover:text-gray-200">Event</a>
                <a href="#" class="hover:text-gray-200">Tentang</a>
                <a href="#" class="hover:text-gray-200">Kontak</a>
            </nav>

            <div class="flex gap-3">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-1 rounded bg-red-600 text-white font-medium hover:bg-red-700">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100">Masuk</a>
                    <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- HERO -->
    <section class="bg-gradient-to-b from-green-300 to-white text-center py-20">
        <h1 class="text-4xl font-extrabold text-gray-800">Bersama Menanam Perubahan di Kota Malang</h1>
        <p class="mt-4 text-lg text-gray-700">
            Temukan, ikuti, dan dukung event ramah lingkungan — dari aksi bersih sungai hingga workshop daur ulang kreatif.
        </p>
        <div class="mt-6 flex justify-center gap-4">
            <a href="#" class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700">
                🌱 Daftar Sekarang
            </a>
            <a href="#" class="px-6 py-3 border border-green-600 text-green-700 rounded-lg hover:bg-green-50">
                Masuk untuk Bergabung
            </a>
        </div>
    </section>

    <!-- EVENT PREVIEW -->
    <section class="max-w-6xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-gray-100 h-48 flex flex-col items-center justify-center rounded-lg text-center">
            <span class="text-gray-700 font-semibold mb-2">Aksi Nyata di Lapangan</span>
            <span class="text-gray-400 text-sm">Bersama komunitas membersihkan Sungai Brantas</span>
        </div>
        <div class="bg-gray-100 h-48 flex flex-col items-center justify-center rounded-lg text-center">
            <span class="text-gray-700 font-semibold mb-2">Kreativitas Hijau</span>
            <span class="text-gray-400 text-sm">Workshop daur ulang sampah plastik menjadi karya seni</span>
        </div>
    </section>

    <!-- WHY GREEN EVENT -->
    <section class="max-w-6xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Mengapa Harus Green Event?</h2>
        <p class="text-gray-600 mb-10">
            Kami percaya setiap langkah kecil bisa memberi dampak besar bagi bumi — mulai dari lingkungan terdekat kita.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">🌳</span>
                </div>
                <div>
                    <h3 class="font-semibold">Event Ramah Alam</h3>
                    <p class="text-sm text-gray-600">Semua kegiatan dirancang untuk minim limbah dan emisi karbon.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">🤝</span>
                </div>
                <div>
                    <h3 class="font-semibold">Kolaborasi Komunitas</h3>
                    <p class="text-sm text-gray-600">Gabung dengan komunitas hijau dan saling berbagi inspirasi positif.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">♻️</span>
                </div>
                <div>
                    <h3 class="font-semibold">Edukasi Berkelanjutan</h3>
                    <p class="text-sm text-gray-600">Ikuti pelatihan dan workshop tentang pengelolaan sampah dan energi.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">🌞</span>
                </div>
                <div>
                    <h3 class="font-semibold">Lokasi Pilihan</h3>
                    <p class="text-sm text-gray-600">Event diadakan di titik-titik Malang yang mendukung konsep hijau.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">📅</span>
                </div>
                <div>
                    <h3 class="font-semibold">Jadwal Fleksibel</h3>
                    <p class="text-sm text-gray-600">Pilih event sesuai minat dan waktu yang kamu punya.</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="w-6 h-6 rounded-full border border-green-500 flex items-center justify-center">
                    <span class="text-green-600 font-bold text-sm">🎁</span>
                </div>
                <div>
                    <h3 class="font-semibold">Reward Hijau</h3>
                    <p class="text-sm text-gray-600">Dapatkan apresiasi lingkungan atas kontribusimu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-100 border-t mt-16 py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm text-gray-700">

            <div>
                <h4 class="font-semibold mb-3">Tentang Kami</h4>
                <p class="text-gray-600 text-sm">
                    Green Event adalah platform untuk menghubungkan warga Malang dengan kegiatan lingkungan yang inspiratif dan berdampak nyata.
                </p>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Eksplor</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-green-600">Event Terbaru</a></li>
                    <li><a href="#" class="hover:text-green-600">Komunitas Hijau</a></li>
                    <li><a href="#" class="hover:text-green-600">Tips Daur Ulang</a></li>
                    <li><a href="#" class="hover:text-green-600">Artikel Edukasi</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-semibold mb-3">Sumber Daya</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:text-green-600">Blog & Cerita</a></li>
                    <li><a href="#" class="hover:text-green-600">Panduan Relawan</a></li>
                    <li><a href="#" class="hover:text-green-600">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-green-600">Kontak Kami</a></li>
                </ul>
            </div>

            <div class="flex items-center gap-4 justify-center md:justify-start">
                <a href="#" title="Instagram"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" class="w-6 h-6" alt="instagram"></a>
                <a href="#" title="Twitter"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="w-6 h-6" alt="twitter"></a>
                <a href="#" title="Facebook"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-6 h-6" alt="facebook"></a>
            </div>

        </div>
        <p class="text-center text-xs text-gray-500 mt-8">
            © {{ date('Y') }} Green Event Malang. Semua hak cipta dilindungi.
        </p>
    </footer>

</body>
</html>
