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
        Schema::create('book_eksemplar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('book_id')->nullable()->references('id')->on('books');
            $table->string('kode_buku', 255)->unique();
            $table->string('kondisi_awal', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_eksemplar');
    }
};
