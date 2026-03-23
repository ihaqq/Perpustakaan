<?php

namespace App\Http\Controllers\API;

use App\Models\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookControllerCopy extends Controller
{
    // Metode untuk mengambil semua data buku
    public function index()
    {
        // Mengambil semua data buku
        
        $books = Book::all();

        // Mengembalikan Data Dalam Format Json
        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    // Metode untuk mengambil data buku berdasarkan ID
    public function show($id)
    {
        // Mencari Buku Berdasarkan ID
        $book = Book::find($id);

        // Jika Buku Tidak Ditemukan
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // Mengembalikan Data Buku Dalam Format Json
        return response()->json([
            'status' => 'success',
            'data' => $book
        ]);
    }

    // Metode untuk Menambah data buku
    public function store(Request $request)
    {
        // Memvalidasi Data Request
            $request->validate([
            // 'id' => 'required|integer',              // ID tidak perlu disertakan karena otomatis di-generate
            'kode_buku' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Menambah Data Buku Baru 
        $book = Book::create($request -> all());

        // Mengembalikan Data Buku Yang Ditambahkan Dalam Format Json
        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book
        ], 201);
    }

    // Metode Untuk Update Data Buku
    public function update(Request $request, $id)
    {
        // Mencari Buku Berdasarkan ID
        $book = Book::find($id);

        // Jika Buku Tidak Ditemukan
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // Memvalidasi Data Request
        $request->validate([
            // 'id' => 'required|integer',              // ID tidak perlu disertakan karena otomatis di-generate
            'kode_buku' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'stok' => 'required|integer',
        ]);

        // Memperbarui Data Buku
        $book->update($request->all());

        // Mengembalikan Data Buku Yang Diperbarui Dalam Format Json
        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil diperbarui',
            'data' => $book
        ], 200);
    }

    // Metode Untuk Hapus Data Buku
    public function destroy($id)
    {
        // Mencari Buku Berdasarkan ID
        $book = Book::find($id);

        // Jika Buku Tidak Ditemukan
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ditemukan'
            ], 404);
        }

        // Menghapus Data Buku
        $book->delete();

        // Mengembalikan Data Buku Yang Dihapus Dalam Format Json
        return response()->json([
            'status' => true,
            'message' => 'Buku berhasil dihapus',
            'data' => $book
        ], 200);
    }
}
