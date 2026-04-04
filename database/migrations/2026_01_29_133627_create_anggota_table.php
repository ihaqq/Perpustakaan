<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();    
            $table->foreignUuid('kelas_id')->constrained('kelas')->cascadeOnDelete();
            
            $table->enum('status', ['Pending', 'Approved'])->default('Pending');  
            $table->string('nomor_induk', 50)->nullable();
            $table->enum('kategori', ['Pelajar', 'Guru'])->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};