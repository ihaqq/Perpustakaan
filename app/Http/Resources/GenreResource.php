<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{

    public function toarray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'nama_genre'        => $this->nama_genre,
            'kategori_buku'     => $this->kategori_buku,
            'deskripsi'         => $this->deskripsi,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}