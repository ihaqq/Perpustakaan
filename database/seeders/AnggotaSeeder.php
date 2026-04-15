<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data dari database
        $users = User::all();
        $kelas = Kelas::all();

        // Validasi jaga-jaga: pastikan User dan Kelas sudah ada
        if ($users->isEmpty() || $kelas->isEmpty()) {
            $this->command->info('Data User atau Kelas kosong! Pastikan UserSeeder dan KelasSeeder dijalankan lebih dulu.');
            return;
        }

        // Looping setiap user yang ada di database untuk dijadikan anggota kelas
        foreach ($users as $user) {
            
            // Logika khusus untuk akun 'Bapak Guru'
            if ($user->username === 'guru123') {
                Anggota::factory()->create([
                    'user_id' => $user->id,
                    'kelas_id' => $kelas->first()->id, // Jadi anggota di kelas pertama
                    'kategori' => 'Guru',
                    'status' => 'Approved',
                    'nomor_induk' => '198001012005011003'
                ]);
            } 
            // Logika untuk user dummy lainnya (Pelajar)
            else {
                Anggota::factory()->create([
                    'user_id' => $user->id,
                    'kelas_id' => $kelas->random()->id, // Masukkan ke kelas secara acak
                    'kategori' => 'Pelajar',
                    'status' => 'Approved'
                ]);
            }
        }
    }
}