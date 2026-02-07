<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
     protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'paket_nama',
        'paket_speed',
        'tipe_koneksi',
        'pppoe_username',
        'pppoe_password',
        'ip_address',
        'status',
    ];

   public function tickets()
{
    return $this->hasMany(Ticket::class);
}



}
