@extends('admin.layout')

@section('content')
{{-- Font Awesome CDN --}}
<script src="https://kit.fontawesome.com/a2e0d6f0b4.js" crossorigin="anonymous"></script>

<div class="max-w-7xl mx-auto bg-white p-6 sm:p-8 rounded-lg shadow-md">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold text-green-700 flex items-center gap-2">
            <i class="fa-solid fa-users"></i>
            Manajemen Pengguna
        </h1>

        <a href="{{ route('admin.users-export') }}"
            class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-green-700 transition focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-offset-2">
            <i class="fa-solid fa-file-csv"></i>
            <span>Export ke CSV</span>
        </a>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-300 flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    {{-- Tabel Pengguna --}}
    <div class="shadow overflow-x-auto rounded-lg">
        <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg text-sm">
            <thead class="bg-green-600 text-white select-none">
                <tr>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(0)">
                        <i class="fa-solid fa-hashtag"></i>
                    </th>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(1)">
                        <i class="fa-solid fa-user"></i> Nama
                    </th>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(2)">
                        <i class="fa-solid fa-id-badge"></i> Username
                    </th>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(3)">
                        <i class="fa-solid fa-envelope"></i> Email
                    </th>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(4)">
                        <i class="fa-solid fa-user-shield"></i> Role
                    </th>
                    <th scope="col" class="px-3 py-3 text-left font-semibold cursor-pointer" onclick="sortTable(5)">
                        <i class="fa-solid fa-calendar-day"></i> Tanggal Daftar
                    </th>
                    <th scope="col" class="px-3 py-3 text-center font-semibold">
                        <i class="fa-solid fa-gear"></i> Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($users as $index => $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 py-3 text-gray-700">{{ $index + 1 }}</td>
                    <td class="px-3 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                    <td class="px-3 py-3 font-medium text-gray-900">{{ $user->username }}</td>
                    <td class="px-3 py-3 text-gray-700 break-all">
    @php
        $email = $user->email;
        $parts = explode('@', $email);
        $username = $parts[0] ?? '';
        $domain = $parts[1] ?? '';
        $masked = strlen($username) > 3
            ? substr($username, 0, 3) . str_repeat('*', max(strlen($username) - 4, 0)) . substr($username, -1)
            : substr($username, 0, 1) . str_repeat('*', max(strlen($username) - 1, 0));
        echo e($masked . '@' . $domain);
    @endphp
</td>

                    <td class="px-3 py-3">
                        <span class="inline-block px-3 py-1 rounded-full text-white text-xs 
                            {{ $user->role === 'admin' ? 'bg-red-500' : 'bg-green-500' }}">
                            <i class="fa-solid {{ $user->role === 'admin' ? 'fa-user-tie' : 'fa-user' }}"></i>
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-3 py-3 text-gray-600 whitespace-nowrap">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-3 py-3 text-center">
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="flex items-center justify-center gap-1 px-3 py-1.5 text-xs sm:text-sm bg-red-600 text-white rounded hover:bg-red-700 transition focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-600 py-6">
                        <i class="fa-regular fa-face-sad-tear"></i> Belum ada pengguna terdaftar.
                    </td>
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

{{-- Sorting Script --}}
<script>
    function sortTable(n) {
        const table = document.getElementById("usersTable");
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const headers = table.querySelectorAll("th");

        headers.forEach((header) => {
            const arrow = header.querySelector(".arrow");
            if (arrow) arrow.remove();
        });

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

        table.dataset.sortOrder = asc ? "asc" : "desc";
        table.dataset.sortColumn = n;

        const arrow = document.createElement("span");
        arrow.classList.add("arrow", "ml-2", "text-xs");
        arrow.textContent = asc ? "▲" : "▼";
        headers[n].appendChild(arrow);
    }
</script>
@endsection
