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
            'kode Buku'     => $this->kode_buku,
            'cover'         => $this->cover ?? null, 
            'judul Buku'    => $this->judul,
            'pengarang'     => $this->pengarang,
            'penerbit'      => $this->penerbit,
            'tahun_terbit'  => $this->tahun_terbit, 
            'kategori'      => $this->Genre->kategori_buku ?? null,
            'genre'         => $this->Genre->nama_genre ?? null,
            'stok'          => $this->stok,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }

}