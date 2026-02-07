<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\MikrotikService;

class PelangganApiController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Pelanggan::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
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

        try {
            $pelanggan = DB::transaction(function () use ($data) {

                // 1️⃣ SIMPAN KE DATABASE
                $pelanggan = Pelanggan::create($data);

                // 2️⃣ JIKA PPPoE → BUAT USER DI MIKROTIK
                if ($data['tipe_koneksi'] === 'pppoe') {
                    app(MikrotikService::class)->addPppoeUser(
                        $data['pppoe_username'],
                        $data['pppoe_password'],
                        $data['paket_nama']
                    );
                }

                return $pelanggan;
            });

            return response()->json([
                'success' => true,
                'message' => 'Pelanggan berhasil ditambahkan',
                'data'    => $pelanggan
            ], 201);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pelanggan',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $data = $request->validate([
            'nama'           => 'required|string',
            'alamat'         => 'required|string',
            'no_hp'          => 'required|string',
            'pppoe_username' => 'nullable|string',
            'paket_speed'    => 'nullable|integer',
            'status'         => 'nullable|in:aktif,nonaktif',
        ]);

        if (isset($data['paket_speed'])) {
            $data['paket_nama'] = $data['paket_speed'] . ' Mbps';
        }

        $pelanggan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil diupdate',
            'data'    => $pelanggan
        ]);
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pelanggan berhasil dihapus'
        ]);
    }
}
