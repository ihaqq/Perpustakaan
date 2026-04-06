<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
{

    public function toarray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'nama_kelas'        => $this->nama_kelas,
            'jurusan'           => $this->jurusan,
            'deskripsi_jurusan' => $this->deskripsi_jurusan,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}