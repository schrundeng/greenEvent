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
   <header class="sticky top-0 z-50 bg-green-500 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <!-- Logo -->
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded" aria-hidden="true">
                GE
            </div>
            <span class="font-semibold">Green Event</span>
        </div>

        <!-- Nav -->
        <nav class="flex gap-6">
            <a href="#" class="font-medium hover:text-gray-100 transition">Beranda</a>
            <a href="/events" class="font-medium hover:text-gray-100 transition">Event</a>
            <a href="/about" class="font-medium hover:text-gray-100 transition">Tentang</a>
        </nav>

        <!-- Auth -->
        <div class="flex gap-3">
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
                <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800">Daftar</a>
            @endauth
        </div>
    </div>
</header>

    {{-- Main --}}
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

    {{-- Lazy Loading Script --}}
    <script>
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
