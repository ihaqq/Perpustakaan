<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Kelas;
use App\RepositoriesInterface\KelasRepositoryInterface;

class KelasRepository implements KelasRepositoryInterface
{
    public function all()
    {
        // Menggunakan Eloquent untuk mengambil semua data book
        return Book::all();
    }

    public function find($id)
    {
        return Book::findOrFail($id);
    }
    public function findById($id)
    {
        // failOrFail akan otomatis melempar ModelNotFoundException jika ID tidak ada (ditangkap oleh Controller)
        return Book::findOrFail($id);
    }
    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        // reuse method findById
        $book = $this->findById($id);
        $book->update($data);
        
        return $book;
    }

    public function delete($id)
    {
        $book = $this->findById($id);
        return $book->delete();
    }
    
    public function getKelasWithQuery(array $params)
    {
        $query = Kelas::query();

        // Search
        if (!empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_kelas', 'like', "%$search%")
                ->orWhere('jurusan', 'like', "%$search%");
            });
        }

        // Filter
        if (!empty($params['jurusan'])) {
            $query->where('jurusan', $params['jurusan']);
        }

        if (!empty($params['nama_kelas'])) {
            $query->where('nama_kelas', $params['nama_kelas']);
        }

        // sortBy
        $sortOrder = 'desc';
        if (!empty($params['sort_order']) && in_array(strtolower($params['sort_order']), ['asc', 'desc'])) {
            $sortOrder = strtolower($params['sort_order']);
        }

        $query->orderBy('created_at', $sortOrder);

        return $query;
    }

    public function getLastBook()
    {
        // Mengambil 1 buku terakhir berdasarkan urutan waktu dibuat (created_at)
        return Book::orderBy('created_at', 'desc')->first();
    }
}
