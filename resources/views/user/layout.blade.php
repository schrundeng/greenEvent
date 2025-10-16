<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Green Event' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    
    {{-- Navbar User --}}
<nav class="bg-[#00C853] text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('user.dashboard') }}" class="flex items-center text-white font-bold text-lg">
            <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2">
                GE
            </div>
            Green Event
        </a>

        <!-- Navigation Links -->
        <div class="flex items-center space-x-6">
            <a href="{{ route('user.dashboard') }}" 
               class="font-medium hover:text-gray-100 transition">Home</a>

            <a href="{{ route('user.registrations') }}" 
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

    {{-- Footer --}}
    <footer class="bg-green-700 text-white text-center py-3 mt-auto">
        <p>&copy; {{ date('Y') }} GreenEvent. All rights reserved.</p>
    </footer>
</body>
</html>
