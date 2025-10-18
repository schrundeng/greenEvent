@extends('layout')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-6">
    <div class="bg-white shadow-lg rounded-2xl p-8 max-w-md w-full border border-gray-100">
        
        {{-- Header --}}
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="bg-[#00C853] text-white font-bold text-2xl rounded-lg px-3 py-2 shadow">
                    GE
                </div>
            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Lupa Kata Sandi?</h1>
            <p class="text-gray-600 text-sm">
                Jangan khawatir! Masukkan email yang terdaftar dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
            </p>
        </div>

        {{-- Form --}}
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm font-medium text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('magic.send') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-medium mb-2">Alamat Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00C853] focus:outline-none placeholder-gray-400"
                    placeholder="contoh@email.com">

                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                class="w-full bg-[#00C853] hover:bg-green-700 text-white font-semibold py-2.5 rounded-lg shadow transition-all duration-200">
                Kirim Tautan Reset
            </button>
        </form>

        {{-- Footer --}}
        <div class="text-center mt-6 text-sm">
            <p class="text-gray-600">Ingat kata sandimu? 
                <a href="{{ route('login') }}" class="text-[#00C853] font-medium hover:underline">
                    Masuk di sini
                </a>
            </p>
        </div>
    </div>
</section>
@endsection
