<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    // =========================
    // REGISTER
    // =========================
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:4',
            'role'     => 'required|in:admin,teknisi',
        ]);

        $user = User::create([
            'username' => $validated['username'],
            'name'     => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'], // 🔥 INI KUNCI
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'user'    => $user,
        ], 201);
    }

    // =========================
    // LOGIN
    // =========================
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Username atau password salah'
            ], 401);
        }

        $user = auth()->user();

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role'  => $user->role,
            'user'  => $user,
        ]);
    }
    // =========================
    // LAPOR GANGGUAN   
    // =========================
    public function laporGangguan(Request $request)
    {
        $pelanggan = Pelanggan::findOrFail($request->pelanggan_id);

        // ambil teknisi random / pertama
        $teknisi = User::where('role', 'teknisi')->first();

        $ticket = Ticket::create([
            'pelanggan_id' => $pelanggan->id,
            'teknisi_id' => $teknisi?->id,
            'judul' => 'Gangguan Internet',
            'deskripsi' => 'Internet pelanggan mati',
            'status' => 'open',
            'created_by' => 'system',
        ]);

        return response()->json([
            'success' => true,
            'data' => $ticket
        ]);
    }
    // =========================
    // BUAT ADMIN TUGAS MANUAL
    // =========================
    public function buatTugas(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required',
            'teknisi_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Ticket::create([
            'pelanggan_id' => $request->pelanggan_id,
            'teknisi_id' => $request->teknisi_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 'open',
            'created_by' => 'admin',
        ]);

        return response()->json(['message' => 'Tugas dibuat']);
    }


    // =========================
    // LOGOUT
    // =========================
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout berhasil'
        ]);
    }
}
