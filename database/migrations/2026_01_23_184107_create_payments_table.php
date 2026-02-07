<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pelanggan_id')
                  ->constrained('pelanggans')
                  ->cascadeOnDelete();

            // =========================
            // SNAPSHOT DATA PELANGGAN
            // =========================
            $table->string('pppoe_username');
            $table->string('nama_pelanggan');

            // 🔥 INI WAJIB (BIAR WA & TAGIHAN BENAR)
            $table->integer('paket_speed');   // contoh: 10, 20, 50
            $table->string('paket_nama');     // contoh: "10 Mbps"

            // =========================
            // PERIODE TAGIHAN
            // =========================
            $table->integer('bulan'); // 1 - 12
            $table->integer('tahun');

            // =========================
            // PEMBAYARAN
            // =========================
            $table->integer('jumlah')->default(0);

            $table->enum('status', ['belum_bayar', 'sudah_bayar'])
                  ->default('belum_bayar');

            $table->timestamp('paid_at')->nullable();
            $table->string('metode')->nullable(); // cash / transfer
            $table->text('catatan')->nullable();

            // =========================
            // WHATSAPP
            // =========================
            $table->timestamp('wa_sent_at')->nullable();

            $table->timestamps();

            // 1 pelanggan hanya 1 payment per bulan
            $table->unique(['pelanggan_id', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
