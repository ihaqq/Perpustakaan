<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    protected $bookService;
    
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }
    public function index()
    {
        try{

            $data = $this->bookService->getAllBooks();

            if(!$data) {
                return ResponseHelper::error(
                    null,
                    'Data buku tidak di temukan',
                    404
                );
            }
            return ResponseHelper::success(
                BookResource::collection($data),
                'Berhasil mengambil data buku'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(null, 'Gagal mengambil data buku' . $th->getMessage());
        }
    }
    public function store(Request $request)
    {
        $data = $request->only(['genres_id','kode_buku', 'judul', 'pengarang', 'penerbit', 'tahun_terbit', 'stok']);
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
