<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasUuids, HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini
    protected $table = 'antrian';

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
        'anggota_id',
        'book_id',
        'tanggal_antri',
        'status',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'anggota_id', 'id');
    }

}
