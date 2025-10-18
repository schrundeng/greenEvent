@extends('admin.layout')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-700">Manajemen Event</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.events-export') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                ⬇️ Export CSV
            </a>
            <a href="{{ route('admin.create-edit') }}"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                + Tambah Event
            </a>
        </div>
    </div>


    {{-- Status badge --}}
    @php
    $statusLabels = [
    'ongoing' => 'Ongoing',
    'coming_soon' => 'Coming Soon',
    'cancelled' => 'Cancelled',
    'ended' => 'Ended',
    ];

    $statusColors = [
    'ongoing' => 'bg-green-100 text-green-700',
    'coming_soon' => 'bg-yellow-100 text-yellow-700',
    'cancelled' => 'bg-red-100 text-red-700',
    'ended' => 'bg-gray-200 text-gray-600',
    ];
    @endphp

    {{-- Filter & Pencarian --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <form method="GET" action="{{ route('admin.event-management') }}" class="flex flex-wrap gap-3">
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari event..."
                class="px-3 py-2 border rounded w-64 focus:outline-none focus:ring focus:ring-green-200">

            <select name="category" class="px-10 pl-2 py-2 border rounded focus:outline-none focus:ring focus:ring-green-200">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>

            <select name="status" class="px-10 pl-2 py-2 border rounded focus:outline-none focus:ring focus:ring-green-200">
                <option value="">Semua Status</option>
                <option value="coming_soon" {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit"
                class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                Filter
            </button>
        </form>
    </div>

    {{-- Tabel Event --}}
    <div class="shadow mt-10 overflow-x-auto mt-4">
        <table id="eventsTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white select-none">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(0)">Judul</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(1)">Kategori</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(2)">Tanggal</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(3)">Lokasi</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(4)">Status</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($events as $event)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $event->title }}</td>
                    <td class="px-4 py-2 font-medium text-gray-900">{{ $event->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $event->start_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 text-sm text-gray-600">{{ $event->location }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 text-xs rounded 
                             {{ $statusColors[$event->status] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ $statusLabels[$event->status] ?? ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2 text-right space-x-2">
                        <a href="{{ route('events.detail.show', $event->id) }}"
                            class="px-3 py-1 text-sm bg-blue-600 text-white rounded">Lihat</a>
                        <a href="{{ route('admin.event-edit', $event->id) }}"
                            class="px-3 py-1 text-sm bg-yellow-600 text-white rounded">Edit</a>
                        <form action="{{ route('admin.events-destroy', $event->id) }}" method="POST" class="inline delete-form">
                            @csrf
                            <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded delete-btn">
                                Hapus
                            </button>
                        </form>


                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-600 py-6">
                        Belum ada event yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $events->links() }}
    </div>
</div>
{{-- Script Sorting ASC/DESC --}}
<script>
    function sortTable(n) {
        const table = document.getElementById("eventsTable");
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

    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi hapus pakai SweetAlert
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: 'Data event ini akan dihapus permanen.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // SweetAlert Toast setelah redirect
        @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('
            success ') }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        @elseif(session('error'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('
            error ') }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        @endif
    });
</script>
@endsection