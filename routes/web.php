<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TeknisiDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminTicketController;
use App\Services\ConnectionMonitorService;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
    

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index']);
    Route::get('/admin/tickets', [AdminTicketController::class, 'index']);


    // Pelanggan CRUD
    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/pelanggan/create', [PelangganController::class, 'create']);
    Route::post('/pelanggan', [PelangganController::class, 'store']);
    Route::get('/pelanggan/{pelanggan}/edit', [PelangganController::class, 'edit']);
    Route::put('/pelanggan/{pelanggan}', [PelangganController::class, 'update']);
    Route::delete('/pelanggan/{pelanggan}', [PelangganController::class, 'destroy']);

    // Status pelanggan + tiket
    Route::get('/pelanggan-status', function () {
        $pelanggans = \App\Models\Pelanggan::with(['tickets' => function ($q) {
            $q->where('status', 'open');
        }])->get();

        return view('pelanggan.status', compact('pelanggans'));
    });
});

/*
|--------------------------------------------------------------------------
| TEKNISI AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:teknisi'])->group(function () {

    Route::get('/teknisi/dashboard', [TeknisiDashboardController::class, 'index']);
    Route::get('/teknisi/tickets', [TicketController::class, 'index']);
    Route::put('/teknisi/tickets/{ticket}/close', [TicketController::class, 'close']);
});

/*
|--------------------------------------------------------------------------
| SYSTEM / TEST
|--------------------------------------------------------------------------
*/
Route::get('/test-connection-check', function (ConnectionMonitorService $service) {
    $service->checkConnections();
    return 'Status pelanggan diperbarui';
});
