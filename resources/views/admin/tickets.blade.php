@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Tiket (Admin)</h1>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="p-2 text-left">Pelanggan</th>
            <th class="p-2 text-left">Judul</th>
            <th class="p-2">Status</th>
            <th class="p-2">Sumber</th>
        </tr>
    </thead>
    <tbody>
        @forelse($tickets as $t)
        <tr class="border-t">
            <td class="p-2">{{ $t->pelanggan->nama ?? '-' }}</td>
            <td class="p-2">{{ $t->judul }}</td>
            <td class="p-2 text-center">{{ strtoupper($t->status) }}</td>
            <td class="p-2 text-center">{{ $t->source }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-4 text-center text-gray-500">
                Tidak ada tiket
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
