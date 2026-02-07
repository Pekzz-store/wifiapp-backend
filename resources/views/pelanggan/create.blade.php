@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Pelanggan</h1>
        <p class="text-sm text-gray-500">
            Tambahkan data pelanggan baru ke sistem
        </p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-xl shadow p-6">

        <form method="POST" action="/pelanggan" class="space-y-5">
            @csrf

            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="Nama pelanggan">
            </div>

            {{-- ALAMAT --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" rows="3"
                          class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                          placeholder="Alamat lengkap"></textarea>
            </div>

            {{-- NO HP --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="08xxxxxxxxxx">
            </div>

            {{-- PAKET INTERNET (BARU) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Paket Internet
                </label>
                <select name="paket_speed" required>
                    <option value="">-- Pilih Paket --</option>
                    <option value="5">5 Mbps</option>
                    <option value="10">10 Mbps</option>
                    <option value="20">20 Mbps</option>
                    <option value="30">30 Mbps</option>
                </select>

            </div>

            {{-- TIPE KONEKSI --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Tipe Koneksi
                </label>
                <select name="tipe_koneksi"
                        class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="pppoe">PPPoE</option>
                    <option value="ip">IP</option>
                </select>
            </div>

            {{-- PPPoE USERNAME --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    PPPoE Username
                </label>
                <input type="text" name="pppoe_username"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="username_pppoe">
            </div>

            {{-- IP ADDRESS --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    IP Address
                </label>
                <input type="text" name="ip_address"
                       class="mt-1 w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                       placeholder="192.168.1.10">
            </div>

            {{-- ACTION --}}
            <div class="flex items-center justify-between pt-4">
                <a href="/pelanggan" class="text-gray-600 hover:text-gray-800">
                    ← Kembali
                </a>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition">
                    💾 Simpan
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
