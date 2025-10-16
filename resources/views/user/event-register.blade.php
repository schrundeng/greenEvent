@extends('user.layout')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-green-700 mb-4">{{ $event->title }}</h1>
    <p class="text-gray-600 mb-2">📅 {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}</p>
    <p class="text-gray-600 mb-2">📍 {{ $event->location }}</p>
    <p class="text-gray-700 mb-6">{{ $event->description }}</p>

    @if($isRegistered)
        <div class="bg-green-100 p-4 rounded text-green-800 font-medium">
            You are already registered for this event.
        </div>
    @else
        <form action="{{ route('user.event-register.store', $event->slug ?? $event->id) }}" 
              method="POST" 
              class="bg-white p-6 rounded-lg shadow-md space-y-4">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            
            <h2 class="text-lg font-semibold text-green-700">Registration Form</h2>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" name="name" value="{{ auth()->user()->username }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" required>
            </div>

            <button type="submit" 
                    class="w-full px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Register for Event
            </button>
        </form>
    @endif
</div>
@endsection
