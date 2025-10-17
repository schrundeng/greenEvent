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
    
    <nav class="sticky top-0 left-0 w-full bg-[#00C853] text-white shadow-md z-[9999]">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center text-white font-bold text-lg">
    <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2 select-none" aria-hidden="true">
        GE
    </div>
    Green Event
</a>
        <!-- Navigation Links -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('user.dashboard') }}" 
               class="font-medium hover:text-gray-100 transition">Home</a>

            <a href="{{-- route('user.event-regis') --}}" 
               class="font-medium hover:text-gray-100 transition">My Events</a>

            <a href="{{ route('user.profile') }}" 
               class="font-medium hover:text-gray-100 transition">Profile</a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        class="font-medium hover:text-gray-100 transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>



    {{-- Main content --}}
    <main class="flex-1 container mx-auto px-4 py-6">
        @yield('content')
    </main>
<footer class="bg-gray-100 border-t mt-16 py-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 text-sm text-gray-700">

            <div>
                <h4 class="font-semibold mb-3">Tentang Kami</h4>
                <p class="text-gray-600 text-sm">
                    Green Event adalah platform untuk menghubungkan warga Malang dengan kegiatan lingkungan yang inspiratif dan berdampak nyata.
                </p>
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
        <p class="text-center text-xs text-gray-500 mt-8">
            © {{ date('Y') }} Green Event Malang. Semua hak cipta dilindungi.
        </p>
    </footer>
</body>
</html>
