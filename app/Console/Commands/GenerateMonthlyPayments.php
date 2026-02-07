<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pelanggan;
use App\Models\Payment;

class GenerateMonthlyPayments extends Command
{
    protected $signature = 'payments:generate';
    protected $description = 'Generate pembayaran bulanan untuk pelanggan aktif';

    public function handle()
    {
        $bulan = now()->month;
        $tahun = now()->year;

        $pelanggans = Pelanggan::where('status', 'aktif')->get();

        foreach ($pelanggans as $p) {
            Payment::firstOrCreate(
                [
                    'pelanggan_id' => $p->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'pppoe_username' => $p->pppoe_username ?? '-',
                    'nama_pelanggan' => $p->nama,
                    'jumlah' => $this->hitungTagihan($p),
                    'status' => 'belum_bayar',
                ]
            );
        }

        $this->info('Pembayaran bulan '.$bulan.'-'.$tahun.' berhasil digenerate');
    }

    private function hitungTagihan($p)
    {
        return match ($p->paket_speed) {
            10 => 100000,
            20 => 150000,
            50 => 200000,
            default => 150000,
        };
    }
}
