@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Edit Pelanggan</h1>
        <p class="text-sm text-gray-500">
            Perbarui data pelanggan & paket internet
        </p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-xl shadow p-6">

        <form method="POST" action="/pelanggan/{{ $pelanggan->id }}" class="space-y-5">
            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" value="{{ $pelanggan->nama }}"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- ALAMAT --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" rows="3"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">{{ $pelanggan->alamat }}</textarea>
            </div>

            {{-- NO HP --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" value="{{ $pelanggan->no_hp }}"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- PAKET INTERNET --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Paket Internet
                </label>
                <select name="paket_speed"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Tidak Diganti --</option>
                    <option value="5" {{ $pelanggan->paket_speed == 5 ? 'selected' : '' }}>5 Mbps</option>
                    <option value="10" {{ $pelanggan->paket_speed == 10 ? 'selected' : '' }}>10 Mbps</option>
                    <option value="20" {{ $pelanggan->paket_speed == 20 ? 'selected' : '' }}>20 Mbps</option>
                    <option value="30" {{ $pelanggan->paket_speed == 30 ? 'selected' : '' }}>30 Mbps</option>
                    <option value="50" {{ $pelanggan->paket_speed == 50 ? 'selected' : '' }}>50 Mbps</option>
                </select>

                <p class="text-xs text-gray-500 mt-1">
                    Paket saat ini: <strong>{{ $pelanggan->paket_nama }}</strong><br>
                    Berlaku sampai: {{ $pelanggan->expired_at }}
                </p>
            </div>

            {{-- TIPE KONEKSI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Tipe Koneksi</label>
                <select name="tipe_koneksi"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="pppoe" {{ $pelanggan->tipe_koneksi == 'pppoe' ? 'selected' : '' }}>PPPoE</option>
                    <option value="ip" {{ $pelanggan->tipe_koneksi == 'ip' ? 'selected' : '' }}>IP</option>
                </select>
            </div>

            {{-- PPPoE USERNAME --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">PPPoE Username</label>
                <input type="text" name="pppoe_username" value="{{ $pelanggan->pppoe_username }}"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- IP ADDRESS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">IP Address</label>
                <input type="text" name="ip_address" value="{{ $pelanggan->ip_address }}"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                    class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="aktif" {{ $pelanggan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $pelanggan->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            {{-- ACTION --}}
            <div class="flex items-center justify-between pt-4">
                <a href="/pelanggan" class="text-gray-600 hover:text-gray-800">
                    ← Kembali
                </a>

                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    💾 Update
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
