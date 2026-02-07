<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'status',
        'pelanggan_id',
        'source',
        'opened_at',
        'closed_at',
        'kendala',
        'closed_by',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    // 🔥 RELASI
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
