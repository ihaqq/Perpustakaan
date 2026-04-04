<?php
namespace App\Http\Controllers\API;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Services\GenreService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends Controller
{
    protected $genreService;
    
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'kategori',
                'per_page'
            ]);

            $query = $this->genreService->getGenrePaginate($params);

            $result = PaginationHelper::paginate(
                $query,
                $params['per_page'] ?? 10
            );

            return ResponseHelper::success(
                [
                    'Genres' => GenreResource::collection(collect($result['data'])),
                    'meta' => $result['meta']
                ],
                'Berhasil mengambil data genre'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data genre ' . $th->getMessage()
            );
        }
    }

    // tanpa pagination
    public function getAll(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'kategori',
            ]);

            // Ambil query builder
            $query = $this->genreService->getGenrePaginate($params);

            // Eksekusi query dengan get()
            $genres = $query->get();

            return ResponseHelper::success(
                [
                    'Genres' => GenreResource::collection($genres),
                    // Hapus 'meta' karena ini bukan pagination
                ],
                'Berhasil mengambil semua data genre'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data genre: ' . $th->getMessage()
            );
        }
    }

    public function store(GenreStoreRequest $request)
    {
        $data = $request->only(['nama_genre', 'kategori_buku', 'deskripsi']);
        return response()->json($this->genreService->createGenre($data));
    }

    public function show($id)
    {
        try {
            // Ambil data genre melalui service
            $book = $this->genreService->getGenreById($id);

            // Return response sukses, format data menggunakan Resource agar konsisten
            return ResponseHelper::success(
                new BookResource($book),
                'Berhasil mengambil detail genre',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Tangkap error jika ID genre tidak ada di database
            return ResponseHelper::error(
                null,
                'Data genre tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Tangkap error sistem lainnya
            return ResponseHelper::error(
                null,
                'Gagal mengambil detail genre: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR // 500 Internal Server Error
            );
        }
    }
    public function update(GenreUpdateRequest $request, $id)
    {
        $data = $request->only(['nama_genre', 'kategori_buku', 'deskripsi']);
        return response()->json($this->genreService->updateGenre($id, $data));
    }

    public function destroy($id)
    {
        try {
            // Eksekusi proses penghapusan melalui service
            $this->genreService->deleteGenre($id);

            // Kembalikan response sukses (data null karena ini aksi delete)
            return ResponseHelper::success(
                null,
                'Berhasil menghapus data genre',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Handle spesifik jika failOrFail() tidak menemukan data
            return ResponseHelper::error(
                null,
                'Data genre tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Handle jika terjadi error lain (misal: database down, foreign key constraint, dll)
            return ResponseHelper::error(
                null,
                'Gagal menghapus data genre: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR // 500 Internal Server Error
            );
        }
    }
}
