<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pelanggan_id')->constrained()->cascadeOnDelete();
        $table->string('judul');
        $table->text('deskripsi')->nullable();
        $table->enum('status', ['open','proses','selesai'])->default('open');
        $table->enum('source', ['auto','manual'])->default('auto');
        $table->timestamp('opened_at')->nullable();
        $table->timestamps();
      });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
