<?php

namespace App\Repositories;

use App\Models\Anggota;
use App\RepositoriesInterface\AnggotaRepositoryInterface;

class AnggotaRepository implements AnggotaRepositoryInterface
{
    public function all()
    {
        // Menggunakan Eloquent untuk mengambil semua data anggota
        return Anggota::all();
    }

    public function find($id)
    {
        return Anggota::findOrFail($id);
    }
    public function findById($id)
    {
        // failOrFail akan otomatis melempar ModelNotFoundException jika ID tidak ada (ditangkap oleh Controller)
        return Anggota::findOrFail($id);
    }
    public function create(array $data)
    {
        return Anggota::create($data);
    }

    public function update($id, array $data)
    {
        // reuse method findById
        $anggota = $this->findById($id);
        $anggota->update($data);
        
        return $anggota;
    }

    public function delete($id)
    {
        $anggota = $this->findById($id);
        return $anggota->delete();
    }
    
    public function getAnggotaWithQuery(array $params)
    {
        // with(['user', 'kelas']) untuk Eager Loading. 
        // agar query tidak (N+1 problem) saat resource memanggil data relasi.
        $query = Anggota::with(['user', 'kelas']);

        // Search
        if (!empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                // Cari berdasarkan nomor_induk di tabel anggota
                $q->where('nomor_induk', 'like', "%$search%")
                  // PERBAIKAN: Gunakan orWhereHas untuk mencari berdasarkan nama di relasi 'user'
                  ->orWhereHas('user', function ($userQuery) use ($search) {
                      $userQuery->where('nama', 'like', "%$search%");
                  });
            });
        }

        // Filter status (Tadi di controller ada 'status', tapi di repo belum dimasukkan)
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        // Filter kelas_id
        if (!empty($params['kelas_id'])) {
            $query->where('kelas_id', $params['kelas_id']);
        }

        // filter jurusan (berdasarkan jurusan di relasi 'kelas')
        if (!empty($params['jurusan'])) {
            $query->whereHas('kelas', function ($kelasQuery) use ($params) {
                $kelasQuery->where('jurusan', 'like', "%{$params['jurusan']}%");
            });
        }
        
        // Filter kelas (berdasarkan nama kelas di relasi 'kelas')
        if (!empty($params['kelas'])) {
            $query->whereHas('kelas', function ($kelasQuery) use ($params) {
                $kelasQuery->where('nama_kelas', 'like', "%{$params['kelas']}%");
            });
        }

        // Filter kategori
        if (!empty($params['kategori'])) {
            $query->where('kategori', $params['kategori']);
        }

        // sortBy
        $sortOrder = 'desc';
        if (!empty($params['sort_order']) && in_array(strtolower($params['sort_order']), ['asc', 'desc'])) {
            $sortOrder = strtolower($params['sort_order']);
        }

        $query->orderBy('created_at', $sortOrder);

        return $query;
    }
}
