@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-sm text-gray-500">
            Ringkasan sistem WiFi & tiket hari ini
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- TOTAL PELANGGAN --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPelanggan }}</p>
                </div>
                <span class="text-blue-500 text-3xl">👥</span>
            </div>
        </div>

        {{-- ONLINE --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-green-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Online</p>
                    <p class="text-3xl font-bold text-green-600">{{ $online }}</p>
                </div>
                <span class="text-green-500 text-3xl">🟢</span>
            </div>
        </div>

        {{-- OFFLINE --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-red-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Offline</p>
                    <p class="text-3xl font-bold text-red-600">{{ $offline }}</p>
                </div>
                <span class="text-red-500 text-3xl">🔴</span>
            </div>
        </div>

        {{-- TIKET OPEN --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-yellow-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Tiket Open</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $ticketOpen }}</p>
                </div>
                <span class="text-yellow-500 text-3xl">📂</span>
            </div>
        </div>

        {{-- TIKET SELESAI --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-blue-400 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Tiket Selesai</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $ticketClosed }}</p>
                </div>
                <span class="text-blue-500 text-3xl">✅</span>
            </div>
        </div>

        {{-- TIKET OTOMATIS --}}
        <div class="bg-white rounded-xl shadow p-5 border-l-4 border-purple-500 hover:shadow-lg transition">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">Tiket Otomatis</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $ticketAuto }}</p>
                </div>
                <span class="text-purple-500 text-3xl">⚙️</span>
            </div>
        </div>

    </div>

    {{-- ACTION BUTTONS --}}
    <div class="flex flex-wrap gap-4">
        <a href="/pelanggan"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
            👥 Kelola Pelanggan
        </a>

        <a href="/admin/tickets"
           class="inline-flex items-center gap-2 bg-gray-800 hover:bg-gray-900 text-white px-5 py-2 rounded-lg shadow transition">
            🎫 Lihat Tiket
        </a>
    </div>

</div>
@endsection
