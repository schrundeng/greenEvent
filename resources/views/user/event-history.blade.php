@extends('user.layout')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-green-700 mb-6 sm:mb-8 border-b-2 border-green-200 pb-2 flex items-center gap-2">
        <i class="fa-solid fa-calendar-check text-green-600 text-xl sm:text-2xl"></i>
        Riwayat Event Saya
    </h1>

    @if($registrations->isEmpty())
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md text-center text-gray-600">
            <i class="fa-solid fa-circle-info text-3xl sm:text-4xl text-gray-400 mb-3"></i>
            <p class="text-base sm:text-lg">Kamu belum mendaftar ke event manapun.</p>
        </div>
    @else
        <div class="space-y-4 sm:space-y-5">
            @foreach($registrations as $reg)
                @php
                    $status = strtolower($reg->status);
                    $statusColor = match($status) {
                        'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                        'accepted' => 'bg-green-100 text-green-800 border-green-300',
                        'rejected' => 'bg-red-100 text-red-800 border-red-300',
                        default => 'bg-gray-100 text-gray-700 border-gray-300'
                    };

                    $statusIcon = match($status) {
                        'pending' => 'fa-clock',
                        'accepted' => 'fa-circle-check',
                        'rejected' => 'fa-circle-xmark',
                        default => 'fa-question-circle'
                    };
                @endphp

                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-4 sm:p-5 flex flex-col md:flex-row justify-between md:items-center gap-3 md:gap-0 border border-gray-100">
                    
                    {{-- Info Event --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-lg sm:text-xl text-gray-800 truncate">{{ $reg->event->title }}</h3>
                        
                        <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-calendar-days text-green-600"></i>
                            {{ $reg->event->start_date->format('d/m/Y') }} - {{ $reg->event->end_date->format('d/m/Y') }}
                        </p>

                        <p class="text-sm text-gray-600 flex items-center gap-1">
                            <i class="fa-solid fa-location-dot text-green-600"></i>
                            <span class="truncate">{{ $reg->event->location }}</span>
                        </p>

                        <div class="mt-2 flex flex-wrap items-center gap-2">
                            <span class="text-sm text-gray-500">Status:</span>
                            <span class="inline-flex items-center gap-1 px-2 py-1 text-xs sm:text-sm font-semibold rounded-full border {{ $statusColor }}">
                                <i class="fa-solid {{ $statusIcon }}"></i>
                                {{ ucfirst($reg->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol Detail --}}
                    <div class="w-full sm:w-auto">
                        <a href="{{ route('events.detail.show', $reg->event->slug) }}"
                            class="block w-full text-center sm:inline-block sm:w-auto px-4 sm:px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition">
                            <i class="fa-solid fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection