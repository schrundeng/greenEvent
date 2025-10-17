<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Green Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session(`success`) }}',
            confirmButtonColor: '#16a34a', // hijau Tailwind
        });
    });
</script>
@endif

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
        <div class="flex gap-6">
            <a href="/" class="hover:text-gray-200">Beranda</a>
            <a href="#" class="hover:text-gray-200">Event</a>
            <a href="#" class="hover:text-gray-200">Tentang</a>
            <a href="#" class="hover:text-gray-200">Kontak</a>
        </div>

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
                    <label class="block font-semibold mb-1">Email/Username</label>
                    <input type="text" name="login" value="{{ old('email') }}" required autofocus class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
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

    {{-- Footer --}}
    <footer class="bg-green-700 text-white text-center py-3 mt-auto">
        <p>&copy; {{ date('Y') }} GreenEvent. All rights reserved.</p>
    </footer>
</body>
</html>
