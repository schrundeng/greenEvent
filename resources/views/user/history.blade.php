@extends('user.layout')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Riwayat Event Saya</h1>

    @if($registrations->isEmpty())
        <div class="bg-white p-6 rounded-lg shadow-md text-center text-gray-600">
            Kamu belum mendaftar ke event manapun.
        </div>
    @else
        <div class="space-y-4">
            @foreach($registrations as $reg)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition p-4 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-lg">{{ $reg->event->title }}</h3>
                        <p class="text-sm text-gray-600">📅 {{ $reg->event->start_date->format('d/m/Y') }} - {{ $reg->event->end_date->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-600">📍 {{ $reg->event->location }}</p>
                        <p class="text-sm text-gray-500">Status Pendaftaran: <span class="font-medium">{{ ucfirst($reg->status) }}</span></p>
                    </div>
                    <a href="{{ route('user.events.show', $reg->event->slug) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Detail
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
