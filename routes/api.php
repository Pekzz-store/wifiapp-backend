<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\PelangganApiController;
use App\Http\Controllers\Api\TicketApiController;
use App\Http\Controllers\Api\PaymentApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthApiController::class, 'logout']);

    // ADMIN + TEKNISI
    Route::middleware('role:admin,teknisi')->group(function () {
        Route::get('/pelanggan', [PelangganApiController::class, 'index']);
        Route::post('/pelanggan', [PelangganApiController::class, 'store']);

        Route::get('/tickets', [TicketApiController::class, 'index']);
    });

    // ADMIN ONLY
    Route::middleware('role:admin')->group(function () {
        Route::put('/pelanggan/{id}', [PelangganApiController::class, 'update']);
        Route::delete('/pelanggan/{id}', [PelangganApiController::class, 'destroy']);

        Route::post('/tickets', [TicketApiController::class, 'store']);

        Route::get('/payments', [PaymentApiController::class, 'index']);
        Route::post('/payments/{id}/bayar', [PaymentApiController::class, 'bayar']);

        Route::get('/payments/history', [PaymentApiController::class, 'history']);
        Route::get('/payments/export', [PaymentApiController::class, 'exportPdf']);

        Route::get('/payments/unpaid', [PaymentApiController::class, 'unpaid']);
        Route::post('/payments/{id}/wa-sent', [PaymentApiController::class, 'waSent']);


    });

    // TEKNISI
    Route::post('/tickets/{id}/close', [TicketApiController::class, 'close']);

    Route::post('/mikrotik/check', function () {
    app(\App\Services\ConnectionMonitorService::class)->checkConnections();

    return response()->json([
        'success' => true,
        'message' => 'Mikrotik checked',
    ]);
    });


});
