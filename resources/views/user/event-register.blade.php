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
        <form id="registerForm"
              action="{{ route('user.event-register.store', $event->slug ?? $event->id) }}" 
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
                <label for="email" class="block text-gray-700 font-semibold mb-1 ">Email</label>
                <input type="email" id="email" name="email" value="{{ auth()->user()->email}}"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
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

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // jangan langsung submit

    Swal.fire({
        title: 'Yakin dengan data yang kamu isi?',
        text: "Pastikan data sudah benar sebelum mendaftar.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, daftar!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); // lanjut submit form
        }
    });
});
</script>

@endsection
