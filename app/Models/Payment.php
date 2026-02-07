<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'pppoe_username',
        'nama_pelanggan',
        'paket_speed',
        'paket_nama',
        'bulan',
        'tahun',
        'jumlah',
        'status',
        'paid_at',
        'metode',
        'catatan',
        'wa_sent_at',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}
