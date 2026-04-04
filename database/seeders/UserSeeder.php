<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat 1 User spesifik untuk login manual
        User::factory()->create([
            'nama' => 'Bapak Guru',
            'username' => 'guru123',
            'email' => 'guru@sekolah.com',
        ]);

        // 2. Buat 20 User dummy (pelajar)
        User::factory(20)->create();
    }
}
