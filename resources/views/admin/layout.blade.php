<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Green Event' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

{{-- Admin Navbar --}}
<nav class="sticky top-0 bg-[#00C853] text-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center text-white font-bold text-lg">
            <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2 select-none" aria-hidden="true">
                GE
            </div>
            Green Event
        </a>

        <!-- Hamburger (Mobile) -->
        <button id="menu-toggle" class="md:hidden text-white text-2xl focus:outline-none">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Navigation -->
        <div id="menu" class="hidden md:flex flex-col md:flex-row items-start md:items-center md:space-x-6 space-y-4 md:space-y-0 absolute md:static top-16 left-0 md:top-auto md:left-auto bg-[#00C853] md:bg-transparent w-full md:w-auto px-6 md:px-0 py-4 md:py-0 shadow-md md:shadow-none transition-all">
            <p class="font-medium hover:text-gray-100 transition">Hi, admin!</p>
            <a href="{{ route('admin.dashboard') }}" class="font-medium hover:text-gray-100 transition">Dashboard</a>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="font-medium hover:text-gray-100 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- Main content --}}
<main class="flex-1 container mx-auto px-4 py-6 w-full">
    @yield('content')
</main>

{{-- Footer --}}
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
                <a href="github.com/schrundeng" class="hover:text-pink-600 text-gray-700 text-2xl transition" title="Github">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://github.com/sternnaufal" class="hover:text-sky-500 text-gray-700 text-2xl transition" title="Github">
                    <i class="fa-brands fa-github"></i>
                </a>
                <a href="https://github.com/ghawra" class="hover:text-blue-600 text-gray-700 text-2xl transition" title="Github">
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

{{-- Script Navbar Toggle --}}
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const menu = document.getElementById('menu');

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('hidden');
    });
</script>

</body>
</html>
