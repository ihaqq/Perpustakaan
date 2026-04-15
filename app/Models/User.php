<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasUuids, HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'users';

    // Menentukan primary key tabel
    protected $primaryKey = 'id';

    // Menentukan apakah primary key auto-increment
    public $incrementing = false;

    // Menentukan tipe data primary key
    protected $keyType = 'string';

    // Menentukan apakah model harus mengelola timestamp created_at dan updated_at
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nama',
        'username',
        'email',
        'password',
        'telepon',
        'foto_profile',
        'gender',
    ];

    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'user_id', 'id');
    }
}
