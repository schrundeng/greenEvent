@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">All Events</h2>

    <div class="row g-4">
        @forelse($events as $event)
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    @if($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="text-muted mb-1"><i class="bi bi-calendar-event"></i> {{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</p>
                        <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $event->location }}</p>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No events found.</p>
        @endforelse
    </div>
</div>
@endsection
