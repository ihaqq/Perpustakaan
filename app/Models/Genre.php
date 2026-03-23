<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasUuids;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'genres';

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
        'nama_genre',
        'kategori_buku',
        'deskripsi',
    ];

    public function books()
    {
        return $this->hasMany(Book::class, 'genres_id');
    }
}
