@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Manajemen Pengguna</h1>
        <a href="{{ route('admin.users-export') }}"
            class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition">
            ⬇️ Export ke CSV
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabel Pengguna --}}
    <div class="shadow overflow-x-auto mt-4">
        <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white select-none">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(0)">#</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(1)">Nama</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(2)">Username</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(3)">Email</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(4)">Role</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(5)">Tanggal Daftar</th>
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
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-600 py-6">Belum ada pengguna terdaftar.</td>
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

{{-- Script Sorting ASC/DESC --}}
<script>
    function sortTable(n) {
        const table = document.getElementById("usersTable");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const headers = table.querySelectorAll("th");

        // Reset semua panah
        headers.forEach((header) => {
            const arrow = header.querySelector(".arrow");
            if (arrow) arrow.remove();
        });

        // Tentukan arah sort
        let asc = table.dataset.sortColumn == n ? table.dataset.sortOrder !== "asc" : true;

        rows.sort((a, b) => {
            const cellA = a.children[n].innerText.trim().toLowerCase();
            const cellB = b.children[n].innerText.trim().toLowerCase();

            if (!isNaN(cellA) && !isNaN(cellB)) {
                return asc ? cellA - cellB : cellB - cellA;
            }
            return asc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        });

        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));

        // Simpan status urutan & kolom
        table.dataset.sortOrder = asc ? "asc" : "desc";
        table.dataset.sortColumn = n;

        // Tambahkan panah arah ke header aktif (tidak menimpa teks)
        const arrow = document.createElement("span");
        arrow.classList.add("arrow");
        arrow.textContent = asc ? "▲" : "▼";
        arrow.classList.add("text-right", "ml-5", "text-gray-200");
        headers[n].appendChild(arrow);
    }
</script>


@endsection