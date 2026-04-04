<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasUuids, HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'kelas';

    // Menentukan primary key tabel
    protected $primaryKey = 'id';

    // Menentukan apakah primary key auto-increment
    public $incrementing = false;

    // Menentukan tipe data primary key
    protected $keyType = 'string';

    // Menentukan apakah model harus mengelola timestamp created_at dan updated_at
    public $timestamps = true;

    // Menentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'kelas',
        'jurusan',
        'deskripsi_jurusan',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class,'anggota_id');
    }

}
