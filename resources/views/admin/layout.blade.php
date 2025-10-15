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
    {{-- Navbar --}}
    <nav class="bg-green-700 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold">🌿 GreenEvent</a>
            <div class="flex space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-green-200">Home</a>
                {{-- <a href="{{ route('admin.events') }}" class="hover:text-green-200">Event</a> --}}
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-green-200">Logout</button>
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
