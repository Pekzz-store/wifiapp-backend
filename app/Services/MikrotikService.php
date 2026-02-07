<?php

namespace App\Services;

class MikrotikService
{
    /**
     * Ambil daftar user PPPoE yang AKTIF di Mikrotik
     * (sementara dummy / simulasi)
     */
    public function getActivePppoeUsers(): array
    {
        // 🔧 NANTI DIGANTI API MIKROTIK ASLI
        return [
            '001-bari',
            
        ];
    }
    public function addPppoeUser(string $username, string $password, string $profile = 'default')
    {
        // nanti isi RouterOS API
        return true;
    }

}
