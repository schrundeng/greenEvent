@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 py-10">
    <h2 class="text-2xl sm:text-3xl font-bold text-center text-gray-800 mb-8 sm:mb-10">
        🌿 Semua Event
    </h2>

    @if($events->isEmpty())
        <p class="text-center text-gray-500 text-sm sm:text-base">
            Tidak ada event yang tersedia saat ini.
        </p>
    @else
        <!-- Responsive Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($events as $index => $event)
                @if ($event->status !== 'draft')
                    <div 
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition duration-300 flex flex-col"
                        data-aos="fade-up"
                        data-aos-delay="{{ $index * 100 }}"
                    >
                        <!-- Poster -->
                        @if($event->poster)
                            <img 
                                src="{{ asset('storage/' . $event->poster) }}"
                                alt="{{ $event->title }}"
                                loading="lazy"
                                class="w-full h-40 sm:h-48 object-cover"
                            >
                        @else
                            <div class="w-full h-40 sm:h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                Tidak ada poster
                            </div>
                        @endif

                        <!-- Konten -->
                        <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                            <div>
                                <!-- Judul & Status -->
                                <div class="flex flex-wrap justify-between items-center mb-2">
                                    <h5 class="font-semibold text-base sm:text-lg text-gray-800 leading-snug">
                                        {{ $event->title }}
                                    </h5>

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

                                    <span class="mt-1 text-xs font-medium px-2 py-1 rounded-full {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
                                        {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                                    </span>
                                </div>

                                <!-- Info Event -->
                                <p class="text-gray-500 text-xs sm:text-sm mb-2 flex items-center gap-1">
                                    <i class="bi bi-calendar-event"></i>
                                    {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                </p>

                                <p class="text-gray-500 text-xs sm:text-sm mb-3 flex items-center gap-1">
                                    <i class="bi bi-geo-alt"></i> {{ $event->location }}
                                </p>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                    {{ $event->description }}
                                </p>
                            </div>

                            <!-- Tombol -->
                            <a href="{{ route('events.detail.show', $event->slug ?? $event->id) }}"
                               class="mt-auto inline-block text-center w-full bg-green-600 text-white py-2 sm:py-2.5 rounded-lg text-sm font-medium hover:bg-green-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection
