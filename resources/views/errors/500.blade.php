@extends('layout')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-red-600 mb-4">500</h1>
        <p class="text-xl text-gray-700 mb-4">Oops! Something went wrong.</p>
        <a href="{{ route('events.index') }}" 
           class="text-green-600 hover:text-green-800 font-medium">
            Back to Events
        </a>
    </div>
</div>
@endsection