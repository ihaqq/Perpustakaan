<?php
namespace App\Http\Controllers\API;

use App\Services\BookService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookControllerCopy extends Controller
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
}
