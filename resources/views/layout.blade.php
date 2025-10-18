<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Green Event' }}</title>

    {{-- Leaflet --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
   <!-- HEADER -->
   <header class="sticky top-0 z-50 bg-green-500 text-white shadow-md">
       <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4 sm:px-6 md:px-8">
           <!-- Logo -->
           <div class="flex items-center gap-2">
               <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded">
                   GE
               </div>
               <span class="font-semibold text-sm sm:text-base">Green Event</span>
           </div>

           <!-- Mobile Menu Button -->
           <button id="menu-toggle" class="block md:hidden text-white text-2xl focus:outline-none">
               <i class="fa-solid fa-bars"></i>
           </button>

           <!-- Nav (desktop) -->
           <nav class="hidden md:flex gap-6 text-sm sm:text-base">
               <a href="/" class="font-medium hover:text-gray-100 transition">Beranda</a>
               <a href="/events" class="font-medium hover:text-gray-100 transition">Event</a>
               <a href="/about" class="font-medium hover:text-gray-100 transition">Tentang</a>
           </nav>

           <!-- Auth -->
           <div class="hidden md:flex gap-3 text-sm sm:text-base">
               @auth
                   <form method="POST" action="{{ route('logout') }}">
                       @csrf
                       <button type="submit"
                               class="px-3 py-1 rounded bg-red-600 text-white font-medium hover:bg-red-700 transition">
                           Keluar
                       </button>
                   </form>
               @else
                   <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100 transition">Masuk</a>
                   <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800 transition">Daftar</a>
               @endauth
           </div>
       </div>

       <!-- Mobile Menu -->
       <div id="mobile-menu" class="hidden flex-col bg-green-600 md:hidden text-white px-4 py-3 space-y-3">
           <a href="/" class="block font-medium hover:text-gray-100 transition">Beranda</a>
           <a href="/events" class="block font-medium hover:text-gray-100 transition">Event</a>
           <a href="/about" class="block font-medium hover:text-gray-100 transition">Tentang</a>

           @auth
               <form method="POST" action="{{ route('logout') }}">
                   @csrf
                   <button type="submit"
                           class="block w-full text-left px-3 py-1 rounded bg-red-600 font-medium hover:bg-red-700 transition">
                       Keluar
                   </button>
               </form>
           @else
               <a href="{{ route('login') }}" class="block px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100 transition">Masuk</a>
               <a href="{{ route('register') }}" class="block px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800 transition">Daftar</a>
           @endauth
       </div>
   </header>

   {{-- MAIN CONTENT --}}
   <main class="flex-1 container mx-auto px-4 sm:px-6 md:px-8 py-8">
       @yield('content')
   </main>

   <!-- FOOTER -->
   <footer class="bg-gradient-to-b from-green-50 to-green-100 border-t border-green-200 mt-12 py-10 sm:py-12">
       <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-sm text-gray-700">

           {{-- Tentang --}}
           <div>
               <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700 text-base sm:text-lg">
                   <i class="fa-solid fa-leaf text-green-600"></i> Tentang Kami
               </h4>
               <p class="text-gray-600 leading-relaxed text-sm sm:text-base">
                   <span class="font-semibold text-green-700">Green Event</span> menghubungkan warga Malang
                   dengan kegiatan lingkungan inspiratif dan berdampak nyata.
               </p>
           </div>

           {{-- Tim --}}
           <div>
               <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700 text-base sm:text-lg">
                   <i class="fa-solid fa-users text-green-600"></i> Tim Kami
               </h4>
               <ul class="space-y-2 text-sm sm:text-base">
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
               <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700 text-base sm:text-lg">
                   <i class="fa-solid fa-share-nodes text-green-600"></i> Ikuti Kami
               </h4>
               <div class="flex items-center gap-5 text-xl">
                   <a href="#" class="hover:text-gray-800 text-gray-600 transition" title="GitHub">
                       <i class="fa-brands fa-github"></i>
                   </a>
                   <a href="#" class="hover:text-blue-500 text-gray-600 transition" title="Twitter">
                       <i class="fa-brands fa-x-twitter"></i>
                   </a>
                   <a href="#" class="hover:text-pink-600 text-gray-600 transition" title="Instagram">
                       <i class="fa-brands fa-instagram"></i>
                   </a>
               </div>
           </div>

           {{-- Kontak --}}
           <div>
               <h4 class="font-semibold mb-4 flex items-center gap-2 text-green-700 text-base sm:text-lg">
                   <i class="fa-solid fa-envelope text-green-600"></i> Hubungi Kami
               </h4>
               <ul class="space-y-2 text-sm sm:text-base">
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

       <div class="mt-10 border-t border-green-200 pt-6 text-center text-xs sm:text-sm text-gray-500">
           © {{ date('Y') }} <span class="font-semibold text-green-700">Green Event Malang</span>. Semua hak cipta dilindungi.
       </div>
   </footer>

   {{-- Script Menu Toggle & Lazy Load --}}
   <script>
       // Mobile Menu Toggle
       const toggleBtn = document.getElementById('menu-toggle');
       const mobileMenu = document.getElementById('mobile-menu');
       toggleBtn?.addEventListener('click', () => {
           mobileMenu.classList.toggle('hidden');
       });

       // Lazy Loading
       document.addEventListener("DOMContentLoaded", () => {
           const lazyElements = document.querySelectorAll('.lazy');
           const observer = new IntersectionObserver((entries, obs) => {
               entries.forEach(entry => {
                   if (entry.isIntersecting) {
                       const el = entry.target;
                       if (el.dataset.src) el.src = el.dataset.src;
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
