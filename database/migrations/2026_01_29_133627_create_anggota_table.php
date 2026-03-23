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
        // Schema::create('anggota', function (Blueprint $table) {
        //     $table->uuid('id')->primary();
        //     $table->foreignUuid('id_user')->references('id')->on('users');      
        //     $table->string('nama',255);                 // masih belum fiks karena masih di tanyakan ke ui ux
        //     $table->string('kelas', 255);
        //     $table->string('username', 255);
        //     $table->enum('role', ['admin','anggota']);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
