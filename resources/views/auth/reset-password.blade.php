<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <title>Reset Password - Green Event</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('
                success ') }}',
                confirmButtonColor: '#16a34a',
            });
        });
    </script>
    @endif

    <header class="sticky top-0 z-50 bg-green-500 text-white shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center py-3 px-4 sm:px-6 md:px-8">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-white text-green-600 flex items-center justify-center font-bold rounded">GE</div>
                <span class="font-semibold text-sm sm:text-base">Green Event</span>
            </div>
            <nav class="hidden md:flex gap-6 text-sm sm:text-base">
                <a href="/" class="font-medium hover:text-gray-100 transition">Beranda</a>
                <a href="/events" class="font-medium hover:text-gray-100 transition">Event</a>
                <a href="/about" class="font-medium hover:text-gray-100 transition">Tentang</a>
            </nav>
            <div class="hidden md:flex gap-3 text-sm sm:text-base">
                <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-white text-green-600 font-medium hover:bg-gray-100 transition">Masuk</a>
                <a href="{{ route('register') }}" class="px-3 py-1 rounded bg-green-700 text-white font-medium hover:bg-green-800 transition">Daftar</a>
            </div>
        </div>
    </header>

    <div class="flex justify-center items-center min-h-[90vh]">
        <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-md">
            <h3 class="text-center mb-6 font-bold text-2xl text-[#00C853]">Reset Password</h3>

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

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4">
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $email) }}" readonly
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="mb-4">
                    <label class="block font-semibold mb-1">New Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="mb-6">
                    <label class="block font-semibold mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#00C853]">
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="w-full bg-[#00C853] text-white font-semibold py-2 rounded-md hover:bg-[#009624] transition">
                        Reset Password
                    </button>
                </div>
            </form>

            <p class="text-center mt-4 text-gray-700">
                Don’t have an account?
                <a href="{{ route('register') }}" class="text-[#00C853] font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </div>

    <footer class="bg-green-700 text-white text-center py-3 mt-auto">
        <p>&copy; {{ date('Y') }} GreenEvent. All rights reserved.</p>
    </footer>

</body>

</html>