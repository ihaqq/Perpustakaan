<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Genre;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        // Validasi: pastikan genre ada
        if (Genre::count() === 0) {
            $this->command->warn('Seeder Genre harus dijalankan terlebih dahulu!');
            return;
        }

        // Generate buku random + relasi ke genre
        Book::factory()->count(30)->create();
    }
}