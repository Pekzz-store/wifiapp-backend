<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{
    // ================= LIST TUGAS =================
    public function index(Request $request)
    {
        $user = $request->user();

        $query = Ticket::with('pelanggan');

        if ($user->role === 'teknisi') {
            $query->where('status', 'open');
        }

        $tickets = $query->latest()->get()->map(function ($t) {
            return [
                'id' => $t->id,
                'judul' => $t->judul,
                'deskripsi' => $t->deskripsi,
                'status' => $t->status,
                'opened_at' => $t->opened_at,
                'closed_at' => $t->closed_at,
                'kendala' => $t->kendala,

                // 🔥 INI KUNCI
                'pppoe_username' => $t->pelanggan?->pppoe_username,
                'pelanggan_nama' => $t->pelanggan?->nama,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $tickets,
        ]);
    }

    // ================= TAMBAH =================
    public function store(Request $request)
    {
        $data = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $ticket = Ticket::create([
            ...$data,
            'status' => 'open',
            'source' => 'manual',
            'opened_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'data' => $ticket
        ], 201);
    }

    // ================= TUTUP =================
    public function close(Request $request, $id)
    {
        $data = $request->validate([
            'closed_at' => 'required|date',
            'kendala' => 'nullable|string',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => 'selesai',
            'closed_at' => $data['closed_at'],
            'kendala' => $data['kendala'],
            'closed_by' => $request->user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tugas berhasil diselesaikan'
        ]);
    }
}
