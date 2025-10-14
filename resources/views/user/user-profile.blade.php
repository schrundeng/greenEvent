@extends('user.layout')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Profil Saya</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <p><span class="font-semibold">Username:</span> {{-- auth()->user()->username --}}</p>
        </div>
        <div class="mb-4">
            <p><span class="font-semibold">Email:</span> {{-- auth()->user()->email --}}</p>
        </div>
        <div class="flex justify-end">
            <a href="{{-- route('/user/edit-profile') --}}" 
               class="px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-700">
               Edit Profil
            </a>
        </div>
    </div>
</div>
@endsection
