<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Ticket;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalPelanggan' => Pelanggan::count(),
            'online' => Pelanggan::where('connection_status','online')->count(),
            'offline' => Pelanggan::where('connection_status','offline')->count(),
            'ticketOpen' => Ticket::where('status','open')->count(),
            'ticketClosed' => Ticket::where('status','selesai')->count(),
            'ticketAuto' => Ticket::where('source','auto')->count(),
        ]);
    }
}
