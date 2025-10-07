<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tabel Admin (hanya satu admin tetap dibuat terpisah)
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        // Tabel Buku
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun_terbit');
            $table->string('kategori');
            $table->string('genre');
            $table->string('gambar_buku')->nullable();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });

        // Tabel Peminjaman
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->enum('status', ['dipinjam', 'selesai'])->default('dipinjam');
            $table->integer('denda_total')->default(0);
            $table->timestamps();
        });

        // Detail Buku dalam Peminjaman
        Schema::create('peminjaman_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->integer('jumlah')->default(1);
        });

        // Tabel Pengembalian
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peminjaman_id')->constrained('peminjaman')->onDelete('cascade');
            $table->date('tanggal_dikembalikan');
            $table->integer('terlambat_hari')->default(0);
            $table->integer('denda_per_hari')->default(1000);
            $table->integer('total_denda')->default(0);
        });

        // Tabel Preorder
        Schema::create('preorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->enum('status', ['menunggu', 'diberitahu', 'selesai', 'dilewati'])->default('menunggu');
            $table->date('tanggal_preorder');
            $table->timestamps();
        });

        // Tabel Notifikasi
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('admin')->default(false);
            $table->text('pesan');
            $table->boolean('dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('preorders');
        Schema::dropIfExists('pengembalian');
        Schema::dropIfExists('peminjaman_detail');
        Schema::dropIfExists('peminjaman');
        Schema::dropIfExists('books');
        Schema::dropIfExists('admin');
        Schema::dropIfExists('users');
    }
};
