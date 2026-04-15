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
        // Tabel Buku
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('genres_id')->nullable()->references('id')->on('genres');
            $table->string('kode_buku', 255)->unique();
            $table->string('judul',255);
            $table->string('pengarang',255);
            $table->string('penerbit',255);
            $table->year('tahun_terbit');
            $table->string('cover')->nullable();
            $table->string('bahasa', 255)->nullable();
            $table->string('lokasi_rak', 255)->nullable();
            $table->integer('jumlah_halaman')->nullable();
            $table->text('sinopsis')->nullable();
            $table->integer('stok_total')->default(0);
            $table->integer('stok_tersedia')->default(0);
            $table->string('kondisi_awal', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
