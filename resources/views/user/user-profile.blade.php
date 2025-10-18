@extends('user.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-3xl font-bold text-green-700 mb-8 flex items-center gap-2">
        <i class="fa-solid fa-user-circle text-green-600"></i> Profil Saya
    </h1>

    <div class="bg-white shadow-lg rounded-2xl p-6 border border-green-100">
        {{-- Bagian Avatar + Info --}}
        <div class="flex flex-col md:flex-row items-center md:items-start md:gap-8">
            {{-- Avatar User --}}
            <div class="mb-6 md:mb-0">
                <div class="w-24 h-24 rounded-full bg-green-100 flex items-center justify-center text-green-700 text-4xl">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            {{-- Info User --}}
            <div class="flex-1 w-full space-y-4">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-user text-green-600 w-5"></i>
                    <p class="text-gray-700">
                        <span class="font-semibold text-green-800">Username:</span> {{ auth()->user()->username }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-envelope text-green-600 w-5"></i>
                    <p class="text-gray-700">
                        <span class="font-semibold text-green-800">Email:</span> {{ auth()->user()->email }}
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-calendar text-green-600 w-5"></i>
                    <p class="text-gray-700">
                        <span class="font-semibold text-green-800">Bergabung sejak:</span>
                        {{ auth()->user()->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-end mt-8">
            <a href="{{ route('user.user-edit') }}" 
               class="inline-flex items-center gap-2 px-5 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                <i class="fa-solid fa-pen-to-square"></i> Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
