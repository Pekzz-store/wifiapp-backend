<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('pelanggan')
            ->latest()
            ->get();

        return view('admin.tickets', compact('tickets'));
    }
}
