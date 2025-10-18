<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Green Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

        {{-- Navbar --}}
    <nav class="bg-green-500 text-white shadow-md">
    <div class="max-w-7xl mx-auto flex justify-between items-center py-4 px-6">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded">
                GE
            </div>
            <span class="font-semibold">Green Event</span>
        </a>

        <!-- Nav Links -->
       <nav class="flex gap-6">
                <a href="#" class="font-medium hover:text-gray-100 transition">Beranda</a>
                <a href="/events" class="font-medium hover:text-gray-100 transition">Event</a>
                <a href="#" class="font-medium hover:text-gray-100 transition">Tentang</a>
                <a href="#" class="font-medium hover:text-gray-100 transition">Kontak</a>
            </nav>

        <!-- Auth Buttons -->
        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800">
                Daftar
            </a>
        </div>
    </div>
</nav>


    {{-- Register Form --}}
    <div class="min-h-[90vh] flex justify-center items-center px-4">
        <div class="bg-white shadow-lg rounded-2xl p-6 w-full max-w-md">
            <h3 class="text-center mb-6 font-bold text-[#00C853] text-2xl">Create Your Account</h3>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 rounded-lg p-3 mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00C853] focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00C853] focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00C853] focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00C853] focus:outline-none" required>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00C853] focus:outline-none" required>
                </div>

                <div>
                <button type="submit"
                        class="w-full bg-[#00C853] text-white font-semibold py-2 rounded-lg hover:bg-[#00a147] transition">
                    Register
                </button>
            </form>

            <p class="text-center mt-4 text-sm">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#00C853] font-semibold hover:underline">
                    Login here
                </a>
            </p>
        </div>
    </div>

    <script>
        // Toggle navbar for mobile
        const toggle = document.getElementById('navbarToggle');
        const menu = document.getElementById('navbarNav');
        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
