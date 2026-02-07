@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Status Pelanggan</h1>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach($pelanggans as $p)
    <div class="bg-white shadow rounded-lg p-4">
        <h2 class="font-semibold text-lg">{{ $p->nama }}</h2>

        <p class="text-sm mt-1">
            Status:
            <span class="{{ $p->connection_status === 'online'
                ? 'text-green-600'
                : 'text-red-600' }}">
                {{ strtoupper($p->connection_status) }}
            </span>
        </p>

        <p class="text-xs text-gray-500 mt-2">
            Tiket aktif: {{ $p->tickets->count() }}
        </p>
    </div>
@endforeach
</div>

@endsection
