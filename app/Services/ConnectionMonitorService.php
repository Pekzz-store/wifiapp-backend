<?php

namespace App\Services;

use App\Models\Pelanggan;
use App\Models\Ticket;
use App\Services\MikrotikService;
use Carbon\Carbon;

class ConnectionMonitorService
{
    /**
     * AMBIL USER PPPoE AKTIF DARI MIKROTIK
     */
    protected function getActivePppoeUsers(): array
    {
        $mikrotik = new MikrotikService();
        return $mikrotik->getActivePppoeUsers();
    }

    /**
     * CEK KONEKSI PELANGGAN
     * - Offline → auto create ticket
     * - Online → auto close ticket (source auto)
     */
    public function checkConnections(): void
    {
        $activeUsers = $this->getActivePppoeUsers();

        $pelanggans = Pelanggan::where('status', 'aktif')->get();

        foreach ($pelanggans as $p) {

            // 🔒 HANYA PPPoE
            if ($p->tipe_koneksi !== 'pppoe') {
                continue;
            }

            // catat waktu cek
            $p->last_checked_at = now();

            /**
             * ======================
             * ONLINE
             * ======================
             */
            if (
                $p->pppoe_username &&
                in_array($p->pppoe_username, $activeUsers)
            ) {
                $p->connection_status = 'online';
                $p->last_online_at = now();

                // ✅ AUTO CLOSE TICKET (HANYA SOURCE AUTO)
                Ticket::where('pelanggan_id', $p->id)
                    ->where('status', 'open')
                    ->where('source', 'auto')
                    ->update([
                        'status'    => 'selesai',
                        'closed_at' => now(),
                    ]);
            }

            /**
             * ======================
             * OFFLINE
             * ======================
             */
            else {
                $p->connection_status = 'offline';

                $offlineMinutes = $p->last_online_at
                    ? Carbon::parse($p->last_online_at)->diffInMinutes(now())
                    : 999;

                $hasOpenTicket = Ticket::where('pelanggan_id', $p->id)
                    ->where('status', 'open')
                    ->where('source', 'auto')
                    ->exists();

                // ✅ AUTO CREATE TICKET
                if ($offlineMinutes >= 3 && !$hasOpenTicket) {
                    Ticket::create([
                        'pelanggan_id' => $p->id,
                        'judul'        => 'Gangguan koneksi otomatis',
                        'deskripsi'    => 'PPPoE ' . $p->pppoe_username . ' tidak aktif di Mikrotik',
                        'status'       => 'open',
                        'source'       => 'auto',
                        'opened_at'    => now(),
                    ]);
                }
            }

            $p->save();
        }
    }
}
