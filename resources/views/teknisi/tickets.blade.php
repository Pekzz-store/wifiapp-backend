@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Daftar Tiket Gangguan</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white shadow rounded overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Pelanggan</th>
                <th class="p-3">Judul</th>
                <th class="p-3">Status</th>
                <th class="p-3">Sumber</th>
                <th class="p-3">Aksi</th>
            </tr>
        </thead>

        <tbody>
        @forelse($tickets as $t)
            <tr class="border-t">
                <td class="p-3">{{ $t->pelanggan->nama ?? '-' }}</td>
                <td class="p-3">{{ $t->judul }}</td>
                <td class="p-3">
                    <span class="px-2 py-1 rounded text-sm
                        {{ $t->status === 'open' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                        {{ strtoupper($t->status) }}
                    </span>
                </td>
                <td class="p-3">{{ $t->source }}</td>
                <td class="p-3">
                    <form method="POST" action="/teknisi/tickets/{{ $t->id }}/close">
                        @csrf
                        @method('PUT')
                        <button class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                            Tutup
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">
                    Tidak ada tiket
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@endsection
