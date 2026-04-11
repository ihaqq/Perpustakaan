<?php
namespace App\Http\Controllers\API;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenreStoreRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\GenreResource;
use App\Services\GenreService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
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
                'per_page',
                'sort_order'
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
        try {
            // Mengambil SEMUA data yang sudah tervalidasi di BookStoreRequest
            $data = $request->validated();

            // Panggil service untuk memproses pembuatan buku dan upload file
            $book = $this->genreService->createGenre($data);

            // Return response sukses menggunakan ResponseHelper
            return ResponseHelper::success(
                new GenreResource($book),
                'Genre berhasil ditambahkan',
                Response::HTTP_CREATED // 201 Created (Standar untuk resource baru)
            );

        } catch (QueryException $e) {
            // Error yang berkaitan dengan database (misal: gagal insert)
            return ResponseHelper::error(
                null,
                'Terjadi kesalahan pada database: ' . $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );

        } catch (\Throwable $th) {
            // Tangkap error sistem lainnya
            return ResponseHelper::error(
                null,
                'Gagal menambahkan genre: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function show($id)
    {
        try {
            // Ambil data genre melalui service
            $book = $this->genreService->getGenreById($id);

            // Return response sukses, format data menggunakan Resource agar konsisten
            return ResponseHelper::success(
                new GenreResource($book),
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
    public function update(GenreStoreRequest $request, $id)
    {
        try {
            // Gunakan validated() agar lebih aman dari mass-assignment vulnerability
            $data = $request->validated();

            // Panggil service untuk memproses pembaruan data dan file gambar
            $book = $this->genreService->updateGenre($id, $data);

            return ResponseHelper::success(
                new GenreResource($book),
                'Genre berhasil diperbarui',
                Response::HTTP_OK
            );

        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error(null, 'Data genre tidak ditemukan', Response::HTTP_NOT_FOUND);
        } catch (QueryException $e) {
            return ResponseHelper::error(null, 'Terjadi kesalahan pada database: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, 'Gagal memperbarui genre: ' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
