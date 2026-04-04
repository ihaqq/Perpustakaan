<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{

    public function toarray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'id_genre'      => $this->genres_id ?? null,
            'kode_buku'     => $this->kode_buku,
            'cover'         => $this->cover ?? null, 
            'judul_buku'    => $this->judul,
            'pengarang'     => $this->pengarang,
            'penerbit'      => $this->penerbit,
            'tahun_terbit'  => $this->tahun_terbit, 
            'bahasa'        => $this->bahasa,
            'lokasi_rak'    => $this->lokasi_rak,
            'jumlah_halaman'=> $this->jumlah_halaman,
            'sinopsis'      => $this->sinopsis,
            'kategori'      => $this->Genre->kategori_buku ?? null,
            'genre'         => $this->Genre->nama_genre ?? null,
            'stok'          => $this->stok,
            'status_stok'   => $this->stok >= 5 ? 'high' : ($this->stok > 0 ? 'low' : 'empty'),
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }

}