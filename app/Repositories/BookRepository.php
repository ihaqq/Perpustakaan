<?php

namespace App\Repositories;

use App\Models\Book;

class Bookrepository implements BookRepositoryInterface
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

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $book = Book::findOrFail($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        return $book->delete();
    }
}
