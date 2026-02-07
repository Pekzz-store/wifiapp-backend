@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Dashboard Teknisi</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white shadow rounded p-4">
        <p class="text-sm text-gray-500">Tiket Open</p>
        <p class="text-2xl font-bold">{{ $open }}</p>
    </div>

    <div class="bg-white shadow rounded p-4">
        <p class="text-sm text-gray-500">Tiket Selesai</p>
        <p class="text-2xl font-bold">{{ $closed }}</p>
    </div>

    <div class="bg-white shadow rounded p-4">
        <p class="text-sm text-gray-500">Tiket Otomatis</p>
        <p class="text-2xl font-bold">{{ $auto }}</p>
    </div>

</div>

<div class="mt-6">
    <a href="/teknisi/tickets"
       class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Lihat Daftar Tiket
    </a>
</div>

@endsection
