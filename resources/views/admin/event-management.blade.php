@extends('admin.layout')

@section('content')
<!-- Tambahkan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h1 class="text-3xl font-bold text-green-700 flex items-center gap-2">
            <i class="fa-solid fa-calendar-days text-green-600"></i> Manajemen Event
        </h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.events-export') }}"
                class="flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-file-export"></i> Export CSV
            </a>
            <a href="{{ route('admin.create-edit') }}"
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <i class="fa-solid fa-plus"></i> Tambah Event
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
    <div class="bg-gradient-to-r from-green-50 to-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('admin.event-management') }}"
            class="flex flex-col md:flex-row md:flex-wrap gap-4 justify-start md:items-center">
            
            <div class="relative w-full md:w-64">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari event..."
                    class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-400">
            </div>

            <div class="relative">
                <i class="fa-solid fa-tags absolute left-3 top-3 text-gray-400"></i>
                <select name="category"
                    class="pl-10 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-400">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="relative">
                <i class="fa-solid fa-circle-info absolute left-3 top-3 text-gray-400"></i>
                <select name="status"
                    class="pl-10 pr-8 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 focus:border-green-400">
                    <option value="">Semua Status</option>
                    <option value="coming_soon" {{ request('status') == 'coming_soon' ? 'selected' : '' }}>Coming Soon</option>
                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="ended" {{ request('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit"
                class="flex items-center gap-2 px-5 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <i class="fa-solid fa-filter"></i> Filter
            </button>
        </form>
    </div>

    {{-- Tabel Event --}}
    <div class="shadow mt-6 overflow-x-auto">
        <table id="eventsTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-green-600 text-white">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(0)">
                        <i class="fa-solid fa-heading mr-1"></i> Judul
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(1)">
                        <i class="fa-solid fa-layer-group mr-1"></i> Kategori
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(2)">
                        <i class="fa-solid fa-calendar mr-1"></i> Tanggal
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(3)">
                        <i class="fa-solid fa-location-dot mr-1"></i> Lokasi
                    </th>
                    <th class="px-4 py-3 text-left text-sm font-semibold cursor-pointer" onclick="sortTable(4)">
                        <i class="fa-solid fa-circle-check mr-1"></i> Status
                    </th>
                    <th class="px-4 py-3 text-center text-sm font-semibold">
                        <i class="fa-solid fa-gears"></i> Aksi
                    </th>
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
                            class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                            <i class="fa-solid fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.event-edit', $event->id) }}"
                            class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-yellow-600 text-white rounded hover:bg-yellow-700">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('admin.events-destroy', $event->id) }}" method="POST"
                            class="inline delete-form">
                            @csrf
                            <button type="submit"
                                class="inline-flex items-center gap-1 px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 delete-btn">
                                <i class="fa-solid fa-trash"></i> Hapus
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

{{-- Script Sorting & SweetAlert tetap sama --}}
<script>
    function sortTable(n) {
        const table = document.getElementById("eventsTable");
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
            if (!isNaN(cellA) && !isNaN(cellB)) return asc ? cellA - cellB : cellB - cellA;
            return asc ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
        });

        tbody.innerHTML = "";
        rows.forEach(row => tbody.appendChild(row));

        table.dataset.sortOrder = asc ? "asc" : "desc";
        table.dataset.sortColumn = n;

        const arrow = document.createElement("span");
        arrow.classList.add("arrow");
        arrow.textContent = asc ? "▲" : "▼";
        arrow.classList.add("text-right", "ml-2", "text-gray-200");
        headers[n].appendChild(arrow);
    }

    document.addEventListener('DOMContentLoaded', function() {
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
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        @if(session('success'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        @elseif(session('error'))
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        @endif
    });
</script>
@endsection
