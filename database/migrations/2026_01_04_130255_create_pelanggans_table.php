<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();

            // Data pelanggan
            $table->string('nama');
            $table->text('alamat');
            $table->string('no_hp');

            // Paket internet (INTI)
            $table->string('paket_nama');      // contoh: 10 Mbps
            $table->integer('paket_speed');    // 10
            

            // Koneksi
            $table->enum('tipe_koneksi', ['pppoe', 'ip']);
            $table->string('pppoe_username')->nullable();
            $table->string('pppoe_password')->nullable();
            $table->string('ip_address')->nullable();

            // Status
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
