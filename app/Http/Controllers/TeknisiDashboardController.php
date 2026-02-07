<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TeknisiDashboardController extends Controller
{
    public function index()
    {
        return view('teknisi.dashboard', [
            'open'   => Ticket::where('status', 'open')->count(),
            'closed' => Ticket::where('status', 'selesai')->count(),
            'auto'   => Ticket::where('source', 'auto')->count(),
        ]);
    }
}
