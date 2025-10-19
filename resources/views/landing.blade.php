<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-10">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Green Event Malang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" href="{{ asset('favicon.ico') }}?">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<body class="antialiased">

    <!-- HEADER -->
    <header class="sticky top-0 z-50 bg-green-500 text-white shadow-md">
  <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6 flex-nowrap overflow-x-auto">
    
    <!-- Logo -->
    <div class="flex items-center gap-2 flex-shrink-0">
      <div class="w-10 h-10 bg-white text-green-600 flex items-center justify-center font-bold rounded" aria-hidden="true">
        GE
      </div>
      <span class="font-semibold whitespace-nowrap">Green Event</span>
    </div>

    <!-- Nav (desktop) -->
    <nav class="hidden md:flex gap-6 flex-shrink-0">
      <a href="#" class="font-medium hover:text-gray-100 transition">Beranda</a>
      <a href="/events" class="font-medium hover:text-gray-100 transition">Event</a>
      <a href="/about" class="font-medium hover:text-gray-100 transition">Tentang</a>
    </nav>

    <!-- Tombol menu (mobile) -->
    <button id="menu-toggle" class="md:hidden text-white text-xl">
      <i class="fa-solid fa-bars"></i>
    </button>

    <!-- Auth -->
    <div class="hidden md:flex gap-3 flex-shrink-0">
      @auth
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="px-3 py-1 rounded bg-red-600 text-white font-medium hover:bg-red-700">
            Keluar
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100">Masuk</a>
        <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-1000">Daftar</a>
      @endauth
    </div>
  </div>

  <!-- Menu mobile dropdown -->
  <div id="mobile-menu" class="hidden md:hidden flex flex-col bg-green-600 text-white px-6 pb-4 space-y-2">
    <a href="#" class="hover:text-gray-200">Beranda</a>
    <a href="/events" class="hover:text-gray-200">Event</a>
    <a href="/about" class="hover:text-gray-200">Tentang</a>
    <div class="border-t border-green-400 pt-2">
      @auth
    <a href="/user/dashboard" class="block font-medium hover:text-gray-100 transition">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="w-full text-left py-2 hover:text-gray-200">Keluar</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="block py-2 hover:text-gray-200">Masuk</a>
        <a href="{{ route('register') }}" class="block py-2 hover:text-gray-200">Daftar</a>
      @endauth
    </div>
  </div>
</header>
<!-- HERO -->
<section class="bg-gradient-to-b from-green-300 to-white text-center py-20 px-6 sm:px-10 md:px-16">
  <h1 data-aos="fade-up" data-aos-delay="400"
      class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-gray-1000 leading-snug">
    Bersama Menanam Perubahan di Kota Malang
  </h1>
  <p data-aos="fade-up" data-aos-delay="500"
     class="mt-4 text-base sm:text-lg md:text-xl text-gray-700 max-w-3xl mx-auto">
    Temukan, ikuti, dan dukung event ramah lingkungan — dari aksi bersih sungai hingga workshop daur ulang kreatif.
  </p>
  <div data-aos="fade-up" data-aos-delay="600"
       class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
    <a href="{{ route('register') }}"
       class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition w-full sm:w-auto flex items-center justify-center gap-2">
      <i class="fa-solid fa-seedling"></i> Daftar Sekarang
    </a>
    <a href="{{ route('login') }}"
       class="px-6 py-3 border border-green-600 text-green-700 rounded-lg hover:bg-green-50 transition w-full sm:w-auto">
      Masuk untuk Bergabung
    </a>
  </div>
</section>

<!-- WHY GREEN EVENT -->
<section class="max-w-6xl mx-auto px-6 sm:px-10 md:px-16 py-16">
  <h2 data-aos="fade-up" class="text-2xl sm:text-3xl font-bold text-gray-1000 mb-6 text-center md:text-left">
    Mengapa Harus Green Event?
  </h2>
  <p data-aos="fade-up" class="text-gray-600 mb-10 text-center md:text-left max-w-2xl mx-auto md:mx-0">
    Kami percaya setiap langkah kecil bisa memberi dampak besar bagi bumi — mulai dari lingkungan terdekat kita.
  </p>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-10">
    <!-- Item 1 -->
    <div data-aos="fade-up" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-tree"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Event Ramah Alam</h3>
        <p class="text-sm text-gray-600">Semua kegiatan dirancang untuk minim limbah dan emisi karbon.</p>
      </div>
    </div>

    <!-- Item 2 -->
    <div data-aos="fade-up" data-aos-delay="100" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-handshake"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Kolaborasi Komunitas</h3>
        <p class="text-sm text-gray-600">Gabung dengan komunitas hijau dan saling berbagi inspirasi positif.</p>
      </div>
    </div>

    <!-- Item 3 -->
    <div data-aos="fade-up" data-aos-delay="200" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-recycle"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Edukasi Berkelanjutan</h3>
        <p class="text-sm text-gray-600">Ikuti pelatihan dan workshop tentang pengelolaan sampah dan energi.</p>
      </div>
    </div>

    <!-- Item 4 -->
    <div data-aos="fade-up" data-aos-delay="300" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-sun"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Lokasi Pilihan</h3>
        <p class="text-sm text-gray-600">Event diadakan di titik-titik Malang yang mendukung konsep hijau.</p>
      </div>
    </div>

    <!-- Item 5 -->
    <div data-aos="fade-up" data-aos-delay="400" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-calendar-days"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Jadwal Fleksibel</h3>
        <p class="text-sm text-gray-600">Pilih event sesuai minat dan waktu yang kamu punya.</p>
      </div>
    </div>

    <!-- Item 6 -->
    <div data-aos="fade-up" data-aos-delay="500" class="flex items-start gap-3">
      <div class="w-10 h-10 rounded-full border border-green-500 flex items-center justify-center text-lg text-green-600">
        <i class="fa-solid fa-gift"></i>
      </div>
      <div>
        <h3 class="font-semibold text-base sm:text-lg">Reward Hijau</h3>
        <p class="text-sm text-gray-600">Dapatkan apresiasi lingkungan atas kontribusimu.</p>
      </div>
    </div>
  </div>
</section>



    <!-- FOOTER -->
    <footer class="bg-gradient-to-b from-green-50 to-green-100 border-t border-green-200 mt-16 py-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-10 text-sm text-gray-700">
        
        {{-- Tentang --}}
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700">
                <i class="fa-solid fa-leaf text-green-600"></i> Tentang Kami
            </h4>
            <p class="text-gray-600 leading-relaxed">
                <span class="font-semibold text-green-700">Green Event</span> adalah platform yang menghubungkan warga Malang
                dengan kegiatan lingkungan yang inspiratif dan berdampak nyata bagi alam sekitar.
            </p>
        </div>

        {{-- Tim --}}
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700">
                <i class="fa-solid fa-users text-green-600"></i> Tim Kami
            </h4>
            <ul class="space-y-2">
                <li class="hover:text-green-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-user text-green-500"></i> Naufal Rakha Putra
                </li>
                <li class="hover:text-green-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-user text-green-500"></i> Muhammad Naufal Ramadhan
                </li>
                <li class="hover:text-green-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-user text-green-500"></i> Ghaura Furqon Nugraha
                </li>
            </ul>
        </div>

        {{-- Sosial Media --}}
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700">
                <i class="fa-solid fa-share-nodes text-green-600"></i> Ikuti Kami
            </h4>
            <div class="flex items-center gap-5">
                <a href="#" class="hover:text-pink-600 text-gray-700 text-2xl transition" title="Github">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="#" class="hover:text-sky-500 text-gray-700 text-2xl transition" title="Github">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="#" class="hover:text-blue-600 text-gray-700 text-2xl transition" title="Github">
                    <i class="fa-brands fa-github"></i>
                </a>
            </div>
        </div>

        {{-- Kontak --}}
        <div>
            <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700">
                <i class="fa-solid fa-envelope text-green-600"></i> Hubungi Kami
            </h4>
            <ul class="space-y-2">
                <li class="flex items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-location-dot text-green-500"></i> Malang, Indonesia
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-envelope text-green-500"></i> greeneventplatform@gmail.com
                </li>
                <li class="flex items-center gap-2 text-gray-600">
                    <i class="fa-solid fa-phone text-green-500"></i> +62 1012 3456 71090
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-10 border-t border-green-200 pt-6 text-center">
        <p class="text-xs text-gray-500">
            © {{ date('Y') }} <span class="font-semibold text-green-700">Green Event Malang</span>. Semua hak cipta dilindungi.
        </p>
    </div>
</footer>
<script>
document.getElementById('menu-toggle').addEventListener('click', function () {
  document.getElementById('mobile-menu').classList.toggle('hidden');
});
</script>


</body>
</html>
