@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-green-700 mb-6">Manajemen Pengguna</h1>

    {{-- Tabel Pengguna --}}
    <a href="{{ route('admin.users-export') }}"
        class="bg-green-600 text-white px-4 mb-1 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
        ⬇️ Export ke CSV
    </a>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto mt-10">
        <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Username</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Role</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold">Tanggal Daftar</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-sm text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ $user->username }}</td>
                    <td class="px-4 py-4 text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-4 py-4 text-sm">
                        <span class="px-4 py-1 rounded-full text-white text-xs 
                                {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-green-500' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 text-sm text-gray-600">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{-- route('admin.users.show', $user->id) --}}"
                                class="px-3 py-1 text-sm bg-blue-500 text-white rounded hover:bg-blue-600">Lihat</a>
                            <a href="{{-- route('admin.users.edit', $user->id) --}}"
                                class="px-3 py-1 text-sm bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</a>
                            <form action="{{-- route('admin.users.destroy', $user->id) --}}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-6">Belum ada pengguna terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>
@endsection