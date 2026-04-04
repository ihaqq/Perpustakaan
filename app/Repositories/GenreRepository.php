<?php

namespace App\Repositories;

use App\Models\Genre;
use App\RepositoriesInterface\GenreRepositoryInterface;

class GenreRepository implements GenreRepositoryInterface
{
    public function all()
    {
        // Menggunakan Eloquent untuk mengambil semua data book
        return Genre::all();
    }

    public function find($id)
    {
        return Genre::findOrFail($id);
    }
    public function create(array $data)
    {
        return Genre::create($data);
    }

    public function update($id, array $data)
    {
        $book = Genre::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = Genre::findOrFail($id);
        return $book->delete();
    }
    
    public function getGenresWithQuery(array $params)
    {
        $query = Genre::query();

        //  Search
        if (!empty($params['search'])) {
            $search = $params['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama_genre', 'like', "%$search%");
            });
        }

        //  Filter
        if (!empty($params['kategori'])) {
            $query->where('kategori_buku', $params['kategori']);
        }

        return $query;
    }
}
