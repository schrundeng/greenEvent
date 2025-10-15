<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-[#00C853]">
        <div class="container mx-auto px-4 py-3 flex flex-wrap items-center justify-between">
            <a href="#" class="flex items-center text-white font-bold text-lg">
                <div class="bg-white text-[#00C853] font-bold rounded px-2 py-1 mr-2">GE</div>
                Green Event
            </a>

            <div class="flex items-center space-x-4">
                <a href="#" class="text-white font-semibold hover:text-gray-200">Home</a>
                <a href="#" class="text-white font-semibold hover:text-gray-200">Event</a>
                <a href="#" class="text-white font-semibold hover:text-gray-200">About</a>
                <a href="#" class="text-white font-semibold hover:text-gray-200">Contact</a>
                <a href="{{ route('login') }}" class="bg-white text-[#00C853] font-semibold px-4 py-2 rounded-md">Sign In</a>
                <a href="{{ route('register') }}" class="bg-[#009624] text-white font-semibold px-4 py-2 rounded-md">Register</a>
            </div>
        </div>
    </nav>

    {{-- Login Form --}}
    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
            <h3 class="text-center mb-6 font-bold text-2xl text-[#00C853]">Welcome Back</h3>

            @if (session('status'))
                <div class="mb-4 p-3 text-sm text-green-800 bg-green-100 rounded-md">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-3 text-sm text-red-800 bg-red-100 rounded-md">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Password</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center text-sm text-gray-700">
                        <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 text-[#00C853] focus:ring-[#00C853]">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-[#00C853] font-semibold hover:underline">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#00C853] text-white font-semibold py-2 rounded-md hover:bg-[#009624] transition">
                    Log In
                </button>
            </form>

            <p class="text-center mt-4 text-gray-700">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#00C853] font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </div>

</body>
</html>
