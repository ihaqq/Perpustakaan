<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
        return [
            'id' => Str::uuid(),
            'user_id' => User::factory(),
            'kelas_id' => Kelas::factory(),
            'status' => fake()->randomElement(['Pending', 'Approved']),
            'nomor_induk' => fake()->numerify('##########'), // 10 digit angka string
            'kategori' => fake()->randomElement(['Pelajar', 'Guru']),
        ];
    }
}
