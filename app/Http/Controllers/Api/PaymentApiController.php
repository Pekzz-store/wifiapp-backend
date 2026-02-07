<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentApiController extends Controller
{
    // =================================================
    // LIST PEMBAYARAN (AUTO GENERATE + SNAPSHOT PAKET)
    // =================================================
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        // ===============================
        // AUTO GENERATE PAYMENT
        // ===============================
        $pelanggans = Pelanggan::where('status', 'aktif')->get();

        foreach ($pelanggans as $p) {

            // 🔒 CEK PAYMENT EXISTING
            $existing = Payment::where('pelanggan_id', $p->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->first();

            // ❗ JIKA SUDAH BAYAR → JANGAN DITIMPA
            if ($existing && $existing->status === 'sudah_bayar') {
                continue;
            }

            // tentukan harga dari paket
            $harga = match ((int) $p->paket_speed) {
                10 => 100000,
                20 => 150000,
                50 => 200000,
                default => 0,
            };

            Payment::updateOrCreate(
                [
                    'pelanggan_id' => $p->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    // snapshot pelanggan
                    'pppoe_username' => $p->pppoe_username ?? '-',
                    'nama_pelanggan' => $p->nama,

                    // snapshot paket
                    'paket_speed' => $p->paket_speed,
                    'paket_nama'  => $p->paket_nama,

                    // harga sesuai paket
                    'jumlah' => $harga,

                    'status' => 'belum_bayar',
                ]
            );
        }

        // ===============================
        // AMBIL DATA PAYMENT
        // ===============================
        $payments = Payment::select(
                'payments.*',
                'pelanggans.no_hp'
            )
            ->join('pelanggans', 'pelanggans.id', '=', 'payments.pelanggan_id')
            ->where('payments.bulan', $bulan)
            ->where('payments.tahun', $tahun)
            ->orderByRaw("FIELD(payments.status, 'belum_bayar', 'sudah_bayar')")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $payments,
        ]);
    }

    // =================================================
    // BAYAR PEMBAYARAN
    // =================================================
    public function bayar(Request $request, $id)
    {
        $request->validate([
            'jumlah'  => 'required|integer|min:0',
            'metode'  => 'required|in:cash,transfer',
            'catatan' => 'nullable|string',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'jumlah'  => $request->jumlah,
            'status'  => 'sudah_bayar',
            'paid_at' => now(),
            'metode'  => $request->metode,
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil disimpan',
        ]);
    }

    // =================================================
    // RIWAYAT PEMBAYARAN
    // =================================================
    public function history(Request $request)
    {
        $query = Payment::query();

        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $data = $query->orderByDesc('paid_at')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    // =================================================
    // EXPORT PDF
    // =================================================
    public function exportPdf(Request $request)
    {
        $bulan = $request->query('bulan');
        $tahun = $request->query('tahun');

        if (!$bulan || !$tahun) {
            return response()->json([
                'success' => false,
                'message' => 'Bulan dan tahun wajib diisi',
            ], 422);
        }

        $sudahBayar = Payment::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'sudah_bayar')
            ->get();

        $belumBayar = Payment::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'belum_bayar')
            ->get();

        $totalPemasukan = $sudahBayar->sum('jumlah');

        $pdf = Pdf::loadView('pdf.laporan_pembayaran', [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'sudahBayar' => $sudahBayar,
            'belumBayar' => $belumBayar,
            'totalPemasukan' => $totalPemasukan,
        ]);

        return response()->streamDownload(
            fn () => print($pdf->output()),
            "laporan-pembayaran-$bulan-$tahun.pdf"
        );
    }

    // =================================================
    // BELUM BAYAR
    // =================================================
    public function unpaid(Request $request)
    {
        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);

        $data = Payment::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('status', 'belum_bayar')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    // =================================================
    // TANDAI WA TERKIRIM
    // =================================================
    public function waSent($id)
    {
        $payment = Payment::findOrFail($id);

        $payment->update([
            'wa_sent_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'WA berhasil ditandai terkirim',
        ]);
    }
}
