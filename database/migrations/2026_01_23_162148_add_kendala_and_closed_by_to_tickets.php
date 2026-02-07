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
        Schema::table('tickets', function (Blueprint $table) {
            $table->text('kendala')->nullable();
            $table->foreignId('closed_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // HAPUS FOREIGN KEY DULU
            $table->dropForeign(['closed_by']);

            // HAPUS KOLOM
            $table->dropColumn(['kendala', 'closed_by']);
        });
    }
};
