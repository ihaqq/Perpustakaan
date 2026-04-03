<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Genre;

class BookFactory extends Factory
{
    public function definition(): array
    {
        $genres = Genre::pluck('id')->toArray();

        return [
            'id' => (string) Str::uuid(),
            'genres_id' => !empty($genres) ? $this->faker->randomElement($genres) : null,

            'kode_buku' => strtoupper($this->faker->bothify('BK-####')),
            'judul' => $this->faker->sentence(3),
            'pengarang' => $this->faker->name(),
            'penerbit' => $this->faker->company(),
            'tahun_terbit' => $this->faker->year(),

            'cover' => null,
            'bahasa' => $this->faker->randomElement(['Indonesia', 'Inggris']),
            'lokasi_rak' => strtoupper($this->faker->bothify('RAK-??-##')),
            'jumlah_halaman' => $this->faker->numberBetween(50, 500),
            'sinopsis' => $this->faker->paragraph(),
            'stok' => $this->faker->numberBetween(0, 20),
            'kondisi_awal' => $this->faker->randomElement(['Baik', 'Rusak Ringan', 'Rusak']),
        ];
    }
}