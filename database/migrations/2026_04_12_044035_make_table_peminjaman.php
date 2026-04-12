<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('anggota_id')->constrained('anggota')->cascadeOnDelete();    
            $table->foreignUuid('book_id')->constrained('books')->cascadeOnDelete();
            $table->dateTime('tanggal_booking')->nullable();
            $table->dateTime('tanggal_pinjam')->nullable();
            $table->dateTime('tenggat_kembali')->nullable();
            $table->dateTime('tanggal_kembali')->nullable();
            $table->integer('denda')->default(0);
            $table->enum('status', ['MENUNGGU_DIAMBIL', 'DIPINJAM', 'KEMBALI', 'TERLAMBAT', 'DIBATALKAN'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_buku');
    }
};