<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jurusan = fake()->randomElement(['Rekayasa Perangkat Lunak', 'Teknik Komputer Jaringan', 'Multimedia', 'Akuntansi']);
        $tingkat = fake()->randomElement(['X', 'XI', 'XII']);
        $nomor = fake()->numberBetween(1, 4);

        return [
            'id' => Str::uuid(),
            'nama_kelas' => "$tingkat $jurusan $nomor",
            'jurusan' => $jurusan,
            'deskripsi_jurusan' => fake()->sentence(),
        ];
    }
}
