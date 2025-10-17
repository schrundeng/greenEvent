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

  {{-- Footer --}}
  <footer class="bg-gray-100 border-t mt-16 py-10">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm text-gray-700">
      <div>
        <h4 class="font-semibold mb-3">Tentang Kami</h4>
        <p class="text-gray-600 text-sm">Green Event adalah platform untuk menghubungkan warga Malang dengan kegiatan lingkungan yang inspiratif dan berdampak nyata.</p>
      </div>
      <div>
        <h4 class="font-semibold mb-3">Our Team</h4>
        <ul class="space-y-2">
          <li class="hover:text-green-600">Naufal Rakha Putra</li>
          <li class="hover:text-green-600">Muhammad Naufal Ramadhan</li>
          <li class="hover:text-green-600">Ghaura Furqon Nugraha</li>
        </ul>
      </div>
      <div class="flex items-center gap-4 justify-center md:justify-start">
        <a href="#" title="Instagram"><img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" class="w-6 h-6" alt="instagram"></a>
        <a href="#" title="Twitter"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" class="w-6 h-6" alt="twitter"></a>
        <a href="#" title="Facebook"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" class="w-6 h-6" alt="facebook"></a>
      </div>
    </div>

    <p class="text-center text-xs text-gray-500 mt-8">© {{ date('Y') }} Green Event Malang. Semua hak cipta dilindungi.</p>
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
  </script>

</body>
</html>
