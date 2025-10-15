<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'books';

    // Menentukan primary key tabel
    protected $primaryKey = 'id';

    // Menentukan apakah primary key auto-increment
    public $incrementing = true;

    // Menentukan tipe data primary key
    protected $keyType = 'int';

    // Menentukan apakah model harus mengelola timestamp created_at dan updated_at
    public $timestamps = true;

    // Menentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'id',
        'kode_buku',
        'judul',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'kategori',
        'genre',
        'stok'
    ];


}
