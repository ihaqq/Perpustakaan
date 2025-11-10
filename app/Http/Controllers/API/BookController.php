<?php
namespace App\Http\Controllers\API;

use App\Services\BookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    protected $bookService;
    
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index()
    {
        return response()->json($this->bookService->getAllBooks());
    }
    public function store(Request $request)
    {
        $data = $request->only(['kode_buku', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'kategori', 'genre', 'stok']);
        return response()->json($this->bookService->createBook($data));
    }
    public function show($id)
    {
        return response()->json($this->bookService->getBookById($id));
    }
    public function update(Request $request, $id)
    {
        $data = $request->only(['kode_buku', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'kategori', 'genre', 'stok']);
        return response()->json($this->bookService->updateBook($id, $data));
    }
    public function destroy($id)
    {
        return response()->json($this->bookService->deleteBook($id));
    }
    public function showByCode($kode_buku)
    {
        return response()->json($this->bookService->getBookByCode($kode_buku));
    }
}
