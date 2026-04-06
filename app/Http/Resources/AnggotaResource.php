<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnggotaResource extends JsonResource
{

    public function toarray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'user_id'       => $this->user_id ?? null,
            'kelas_id'      => $this->kelas_id ?? null,
            'foto_profile'  => $this->user->foto_profile ?? null,
            'nama'          => $this->user->nama ?? null,
            'username'      => $this->user->username ?? null,
            'nomor_induk'   => $this->nomor_induk ?? null, 
            'kelas'         => $this->kelas->nama_kelas ?? null,
            'jurusan'       => $this->kelas->jurusan ?? null,
            'gender'        => $this->user->gender ?? null,
            'telepon'       => $this->user->telepon ?? null,
            'email'         => $this->user->email ?? null,
            'tanggal_gabung'=> $this->created_at ? $this->created_at->format('Y-m-d') : null,
            'kategori'      => $this->kategori,
            'status'        => $this->status,
            'pinjaman_aktif'=> $this->pinjaman_count ?? 0, // Jumlah buku yang sedang dipinjam anggota
            'total_pinjaman'=> $this->pinjaman_sum_jumlah ?? 0, // Total jumlah buku yang dipinjam anggota
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }

}