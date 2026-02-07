@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="space-y-6">

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Pelanggan</h1>
            <p class="text-sm text-gray-500">Kelola data pelanggan WiFi</p>
        </div>

        <a href="/pelanggan/create"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
            ➕ Tambah Pelanggan
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Kontak</th>
                    <th class="px-4 py-3">Koneksi</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($pelanggans as $pelanggan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 font-medium text-gray-800">
                            {{ $pelanggan->nama }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $pelanggan->kontak ?? '-' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ strtoupper($pelanggan->koneksi) }}
                        </td>

                        <td class="px-4 py-3">
                            @if ($pelanggan->status === 'aktif')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="/pelanggan/{{ $pelanggan->id }}/edit"
                                   class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded text-xs">
                                    ✏️ Edit
                                </a>

                                <form action="/pelanggan/{{ $pelanggan->id }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded text-xs">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">
                            Belum ada data pelanggan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
