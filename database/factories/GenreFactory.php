<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GenreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'nama_genre' => $this->faker->word(),
            'kategori_buku' => $this->faker->randomElement(['Fiksi', 'Non Fiksi']),
            'deskripsi' => $this->faker->sentence(),
        ];
    }
}