<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['nama' => 'Fantasi', 'kategori' => 'Fiksi', 'deskripsi' => 'Cerita dengan unsur magis dan imajinatif'],
            ['nama' => 'Romantis', 'kategori' => 'Fiksi', 'deskripsi' => 'Cerita yang berfokus pada hubungan percintaan'],
            ['nama' => 'Horor', 'kategori' => 'Fiksi', 'deskripsi' => 'Cerita yang menimbulkan rasa takut'],
            ['nama' => 'Biografi', 'kategori' => 'Non Fiksi', 'deskripsi' => 'Kisah hidup seseorang'],
            ['nama' => 'Sejarah', 'kategori' => 'Non Fiksi', 'deskripsi' => 'Buku tentang peristiwa masa lalu'],
            ['nama' => 'Teknologi', 'kategori' => 'Non Fiksi', 'deskripsi' => 'Buku tentang perkembangan teknologi'],
            ['nama' => 'Self Improvement', 'kategori' => 'Non Fiksi', 'deskripsi' => 'Pengembangan diri'],
        ];

        foreach ($genres as $genre) {
            Genre::create([
                'id' => (string) Str::uuid(),
                'nama_genre' => $genre['nama'],
                'kategori_buku' => $genre['kategori'],
                'deskripsi' => $genre['deskripsi'],
            ]);
        }
    }
}