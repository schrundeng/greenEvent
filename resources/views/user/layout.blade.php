<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title ?? 'Green Event' }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

  {{-- Navbar --}}
  <nav class="sticky top-0 left-0 w-full bg-[#00C853] text-white shadow-md z-[9999]">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
      <!-- Logo -->
      <a href="/" class="flex items-center text-white font-bold text-lg">
        <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2 select-none" aria-hidden="true">GE</div>
        <span class="hidden sm:inline">Green Event</span>
      </a>

      <!-- Hamburger (mobile only) -->
      <button id="menu-toggle" aria-controls="menu-mobile" aria-expanded="false" class="block md:hidden focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <!-- Desktop menu -->
      <div class="hidden md:flex items-center space-x-6">
        <a href="{{ route('user.dashboard') }}" class="font-medium hover:text-gray-100 transition">Home</a>
        <a href="{{ route('user.event-history') }}" class="font-medium hover:text-gray-100 transition"><i class="fa fa-calendar mr-2" aria-hidden="true"></i>My Events</a>
        <a href="{{ route('user.profile') }}" class="font-medium hover:text-gray-100 transition"><i class="fa-solid fa-user-tie mr-2" aria-hidden="true"></i> <!-- versi pakai dasi -->Hi, {{ auth()->user()->username ?? '' }}!</a>
        <form id="logout-form-desktop" method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="button" id="logout-btn-desktop" class="px-3 py-1 rounded bg-red-600 text-white font-medium hover:bg-red-700">
            Logout
          </button>
        </form>
      </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div id="menu-mobile" class="hidden md:hidden bg-[#00C853] px-6 pb-4 space-y-2">
      <a href="{{ route('user.dashboard') }}" class="block font-medium hover:text-gray-100 transition py-2">Home</a>
      <a href="{{ route('user.event-history') }}" class="block font-medium hover:text-gray-100 transition py-2">My Events</a>
      <a href="{{ route('user.profile') }}" class="block font-medium hover:text-gray-100 transition py-2">Profile</a>

      <form id="logout-form-mobile" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="button" id="logout-btn-mobile" class="w-full px-3 py-1 rounded bg-red-600 text-white font-medium hover:bg-red-700">
          Logout
        </button>
      </form>
    </div>
  </nav>

  {{-- Main content --}}
  <main class="flex-1 container mx-auto px-4 py-6">
    @yield('content')
  </main>

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
                    <i class="fa-solid fa-phone text-green-500"></i> +62 812 3456 7890
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

  {{-- Scripts --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Toggle mobile menu
      const btn = document.getElementById('menu-toggle');
      const menuMobile = document.getElementById('menu-mobile');

      btn.addEventListener('click', function () {
        const isHidden = menuMobile.classList.contains('hidden');
        menuMobile.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
      });

      // SweetAlert logout handler (desktop + mobile)
      const logoutDesktopBtn = document.getElementById('logout-btn-desktop');
      const logoutDesktopForm = document.getElementById('logout-form-desktop');
      const logoutMobileBtn = document.getElementById('logout-btn-mobile');
      const logoutMobileForm = document.getElementById('logout-form-mobile');

      const confirmLogout = (btn, form) => {
        if (!btn || !form) return;
        btn.addEventListener('click', function () {
          Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari akun ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#16a34a',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) form.submit();
          });
        });
      };

      confirmLogout(logoutDesktopBtn, logoutDesktopForm);
      confirmLogout(logoutMobileBtn, logoutMobileForm);
    });
document.addEventListener("DOMContentLoaded", () => {
    const lazyElements = document.querySelectorAll('.lazy');
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                // Untuk gambar
                if (el.dataset.src) el.src = el.dataset.src;
                // Fade in efek
                el.parentElement.classList.add('opacity-100');
                obs.unobserve(el);
            }
        });
    }, { threshold: 0.1 });

    lazyElements.forEach(el => observer.observe(el));
});
  </script>

</body>
</html>
