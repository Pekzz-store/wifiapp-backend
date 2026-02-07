<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {
        $pelanggans = Pelanggan::latest()->get();
        return view('pelanggan.index', compact('pelanggans'));
    }

    // =========================
    // FORM TAMBAH
    // =========================
    public function create()
    {
        return view('pelanggan.create');
    }

    // =========================
    // SIMPAN DATA
    // =========================
    public function store(Request $request)
{
    // DEBUG: lihat data yang masuk
    // return response()->json($request->all());

    $data = $request->validate([
        'nama'           => 'required|string',
        'alamat'         => 'required|string',
        'no_hp'          => 'required|string',
        'paket_speed'    => 'required|integer',
        'tipe_koneksi'   => 'required|in:pppoe,ip',
        'pppoe_username' => 'nullable|string',
        'pppoe_password' => 'nullable|string',
        'ip_address'     => 'nullable|string',
    ]);

    $data['paket_nama'] = $data['paket_speed'] . ' Mbps';
    $data['status'] = 'aktif';

    $pelanggan = Pelanggan::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Pelanggan berhasil ditambahkan',
        'data'    => $pelanggan
    ], 201);
}

    // =========================
    // FORM EDIT
    // =========================
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $data = $request->validate([
            'nama'           => 'required',
            'alamat'         => 'required',
            'no_hp'          => 'required',
            'paket_speed'    => 'required|integer',
            'tipe_koneksi'   => 'required|in:pppoe,ip',
            'pppoe_username' => 'nullable',
            'ip_address'     => 'nullable',
            'status'         => 'required|in:aktif,nonaktif',
        ]);

        // PAKET
        $data['paket_nama'] = $request->paket_speed . ' Mbps';

        $pelanggan->update($data);

        return redirect('/pelanggan')->with('success', 'Pelanggan berhasil diupdate');
    }

    // =========================
    // HAPUS DATA
    // =========================
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect('/pelanggan')->with('success', 'Pelanggan berhasil dihapus');
    }
}
