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
    <nav class="bg-[#00C853] shadow">
        <div class="container mx-auto px-4 py-3 flex flex-wrap justify-between items-center">
            <a href="#" class="flex items-center text-white font-bold text-lg">
                <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2">GE</div>
                Green Event
            </a>

            <button class="block lg:hidden text-white focus:outline-none" id="navbarToggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <div class="hidden w-full lg:flex lg:w-auto lg:items-center mt-3 lg:mt-0" id="navbarNav">
                <ul class="flex flex-col lg:flex-row lg:items-center lg:space-x-6 text-white font-semibold">
                    <li><a href="#" class="hover:text-green-100">Home</a></li>
                    <li><a href="#" class="hover:text-green-100">Event</a></li>
                    <li><a href="#" class="hover:text-green-100">About</a></li>
                    <li><a href="#" class="hover:text-green-100">Contact</a></li>

                    <li>
                        <a href="{{ route('login') }}" class="inline-block mt-2 lg:mt-0 bg-white text-[#00C853] font-semibold px-4 py-2 rounded hover:bg-gray-100 transition">
                            Sign In
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="inline-block mt-2 lg:mt-0 bg-[#009624] text-white font-semibold px-4 py-2 rounded hover:bg-[#007b20] transition">
                            Register
                        </a>
                    </li>
                </ul>
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
