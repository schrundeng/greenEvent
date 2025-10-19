@extends('user.layout')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Judul Event --}}
    <h1 class="text-2xl sm:text-3xl font-bold text-green-700 mb-4">{{ $event->title }}

    {{-- Info Event --}}
    <div class="text-gray-600 mb-6 space-y-1 sm:space-y-2">
        <p>📅 {{ $event->start_date->format('d/m/Y') }} - {{ $event->end_date->format('d/m/Y') }}</p>
        <p>📍 {{ $event->location }}</p>
    </div>

    {{-- Deskripsi --}}
    <p class="text-gray-700 mb-6">{{ $event->description }}</p>

    @if($isRegistered)
        <div class="bg-green-100 p-4 rounded text-green-800 font-medium text-center">
            You are already registered for this event.
        </div>
    @else
        {{-- Form Registrasi --}}
        <form id="registerForm"
              action="{{ route('user.event-register.store', $event->slug ?? $event->id) }}" 
              method="POST" 
              class="bg-white p-4 sm:p-6 rounded-lg shadow-md space-y-4">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            
            <h2 class="text-lg sm:text-xl font-semibold text-green-700 mb-2">Registration Form</h2>
            
            {{-- Nama --}}
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ auth()->user()->username }}" 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-3 py-2 sm:py-2.5" required>
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" 
                       class="w-full border border-gray-300 rounded px-3 py-2 sm:py-2.5 bg-gray-100 text-gray-500 cursor-not-allowed" readonly>
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ auth()->user()->phone ?? '' }}" 
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 px-3 py-2 sm:py-2.5" required>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" 
                    class="w-full sm:w-auto block px-4 sm:px-6 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-center font-medium">
                Register for Event
            </button>
        </form>
    @endif
</div>

{{-- SweetAlert konfirmasi --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registerForm');
    if(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

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
                    this.submit();
                }
            });
        });
    }
});
</script>
@endsection
