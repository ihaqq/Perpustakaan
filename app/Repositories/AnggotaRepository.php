<?php

namespace App\Repositories;

use App\Models\Book;
use App\RepositoriesInterface\AnggotaRepositoryInterface;

class AnggotaRepository implements AnggotaRepositoryInterface
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
    
    public function getBooksWithQuery(array $params)
    {
        $query = Book::query();

        // Search
        if (!empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%$search%")
                ->orWhere('kode_buku', 'like', "%$search%");
            });
        }

        // Filter
        if (!empty($params['genre_id'])) {
            $query->where('genres_id', $params['genre_id']);
        }

        if (!empty($params['tahun'])) {
            $query->where('tahun_terbit', $params['tahun']);
        }

        // Filter Stok
        if (!empty($params['stok'])) {
            $kategoriStok = strtolower($params['stok']);

            if ($kategoriStok == 'high') {
                $query->where('stok','>=', '5');
            } elseif ($kategoriStok == 'low') {
                $query->where('stok', [1, 4]);
            } elseif ($kategoriStok == 'empty') {
                $query->where('stok', '<=','0');
            }
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
