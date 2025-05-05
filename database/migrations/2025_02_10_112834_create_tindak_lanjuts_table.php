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
        Schema::create('tindak_lanjuts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('laporan_id'); // Foreign key ke tabel laporans
            $table->text('penanganan')->nullable();
            $table->enum('status', ['diterima', 'diproses', 'selesai'])->default('diterima');
            $table->unsignedBigInteger('petugas_id')->nullable(); // Foreign key ke tabel users (petugas)
            $table->timestamps();

            $table->foreign('laporan_id')->references('id')->on('laporans')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindak_lanjuts');
    }
};
