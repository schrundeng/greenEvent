@extends('user.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-green-700 mb-6 sm:mb-8 flex items-center gap-2 justify-center sm:justify-start">
        <i class="fa-solid fa-user-circle text-green-600 text-3xl sm:text-4xl"></i>
        Profil Saya
    </h1>

    <div class="bg-white shadow-lg rounded-2xl p-5 sm:p-8 border border-green-100">
        {{-- Bagian Avatar + Info --}}
        <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
            {{-- Avatar User --}}
            <div class="flex-shrink-0">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-full bg-green-100 flex items-center justify-center text-green-700 text-4xl sm:text-5xl shadow-inner">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            {{-- Info User --}}
            <div class="flex-1 w-full space-y-4 text-center md:text-left">
                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 justify-center md:justify-start">
                    <i class="fa-solid fa-user text-green-600 w-5 mx-auto sm:mx-0 mb-1 sm:mb-0"></i>
                    <p class="text-gray-700 text-sm sm:text-base">
                        <span class="font-semibold text-green-800">Username:</span> {{ auth()->user()->username }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 justify-center md:justify-start">
                    <i class="fa-solid fa-envelope text-green-600 w-5 mx-auto sm:mx-0 mb-1 sm:mb-0"></i>
                    <p class="text-gray-700 text-sm sm:text-base">
                        <span class="font-semibold text-green-800">Email:</span> {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 justify-center md:justify-start">
                    <i class="fa-solid fa-calendar text-green-600 w-5 mx-auto sm:mx-0 mb-1 sm:mb-0"></i>
                    <p class="text-gray-700 text-sm sm:text-base">
                        <span class="font-semibold text-green-800">Bergabung sejak:</span>
                        {{ auth()->user()->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-center md:justify-end mt-8">
            <a href="{{ route('user.user-edit') }}" 
               class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white text-sm sm:text-base font-semibold rounded-lg hover:bg-green-700 transition-all">
                <i class="fa-solid fa-pen-to-square"></i> Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
