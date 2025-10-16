@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">🌿 Semua Event</h2>

    @if($events->isEmpty())
    <p class="text-center text-gray-500">Tidak ada event yang tersedia saat ini.</p>
    @else
    <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-8">
        @foreach($events as $event)
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <!-- Poster -->
            @if($event->poster)
            <img src="{{ asset('storage/' . $event->poster) }}"
                alt="{{ $event->title }}"
                class="w-full h-48 object-cover">
            @else
            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                Tidak ada poster
            </div>
            @endif

            <!-- Konten -->
            <div class="p-5">
                <div class="flex justify-between items-center mb-2">
                    <h5 class="font-semibold text-lg text-gray-800">
                        {{ $event->title }}
                    </h5>
                    {{-- Status badge --}}
                    @php
                    $statusLabels = [
                    'ongoing' => 'Ongoing',
                    'coming_soon' => 'Coming Soon',
                    'cancelled' => 'Cancelled',
                    'ended' => 'Ended',
                    ];

                    $statusColors = [
                    'ongoing' => 'bg-green-100 text-green-700',
                    'coming_soon' => 'bg-yellow-100 text-yellow-700',
                    'cancelled' => 'bg-red-100 text-red-700',
                    'ended' => 'bg-gray-200 text-gray-600',
                    ];
                    @endphp

                    <span class="text-xs font-medium px-2 py-1 rounded-full {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
                                {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                            </span>
                        </div>

                        <p class=" text-gray-500 text-sm mb-2 flex items-center gap-1">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                        </p>

                        <p class="text-gray-500 text-sm mb-3 flex items-center gap-1">
                            <i class="bi bi-geo-alt"></i> {{ $event->location }}
                        </p>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $event->description }}
                        </p>

                        <a href="{{ route('events.detail.show', $event->slug ?? $event->id) }}"
                            class="inline-block text-center w-full bg-green-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition">
                            Lihat Detail
                        </a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endsection