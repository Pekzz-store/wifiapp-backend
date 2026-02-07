<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // TEKNISI: lihat tiket open
        if ($user->role === 'teknisi') {
            $tickets = Ticket::where('status', 'open')
                ->latest()
                ->get();
        }
        // ADMIN: lihat semua
        else {
            $tickets = Ticket::latest()->get();
        }

        return response()->json([
            'success' => true,
            'data' => $tickets
        ]);
    }

    public function close(Ticket $ticket)
    {
        $ticket->update([
            'status' => 'closed',
            'closed_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tiket ditutup'
        ]);
    }
}
