<?php
namespace App\Http\Controllers\API;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\KelasResource;
use App\Services\KelasService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KelasController extends Controller
{
    protected $kelasService;
    
    public function __construct(KelasService $kelasService)
    {
        $this->kelasService = $kelasService;
    }
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'jurusan',
                'nama_kelas',
                'per_page',
                'sort_order'
            ]);

            $query = $this->kelasService->getKelas($params);

            $result = PaginationHelper::paginate(
                $query,
                $params['per_page'] ?? 10
            );

            return ResponseHelper::success(
                [
                    'kelas' => KelasResource::collection(collect($result['data'])),
                    'meta' => $result['meta']
                ],
                'Berhasil mengambil data kelas'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data kelas ' . $th->getMessage()
            );
        }
    }

    // tanpa pagination
    public function getAll(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'jurusan',
                'nama_kelas'
            ]);

            // Ambil query builder
            $query = $this->kelasService->getKelas($params);

            // Eksekusi query dengan get()
            $kelas = $query->get();

            return ResponseHelper::success(
                [
                    'Kelas' => KelasResource::collection($kelas),
                    // Hapus 'meta' karena ini bukan pagination
                ],
                'Berhasil mengambil semua data kelas'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data kelas: ' . $th->getMessage()
            );
        }
    }

    public function store(BookStoreRequest $request)
    {
        try {
            // Mengambil SEMUA data yang sudah tervalidasi di BookStoreRequest
            $data = $request->validated();

            // Panggil service untuk memproses pembuatan buku dan upload file
            $book = $this->bookService->createBook($data);

            // Return response sukses menggunakan ResponseHelper
            return ResponseHelper::success(
                new BookResource($book),
                'Buku berhasil ditambahkan',
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
                'Gagal menambahkan buku: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    public function show($id)
    {
        try {
            // Ambil data buku melalui service
            $book = $this->bookService->getBookById($id);

            // Return response sukses, format data menggunakan Resource agar konsisten
            return ResponseHelper::success(
                new BookResource($book),
                'Berhasil mengambil detail buku',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Tangkap error jika ID buku tidak ada di database
            return ResponseHelper::error(
                null,
                'Data buku tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Tangkap error sistem lainnya
            return ResponseHelper::error(
                null,
                'Gagal mengambil detail buku: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR // 500 Internal Server Error
            );
        }
    }

    public function update(BookUpdateRequest $request, $id)
    {
        try {
            // Gunakan validated() agar lebih aman dari mass-assignment vulnerability
            $data = $request->validated(); 
            
            // Panggil service untuk memproses pembaruan data dan file gambar
            $book = $this->bookService->updateBook($id, $data);

            return ResponseHelper::success(
                new BookResource($book),
                'Buku berhasil diperbarui',
                Response::HTTP_OK
            );

        } catch (ModelNotFoundException $e) {
            return ResponseHelper::error(null, 'Data buku tidak ditemukan', Response::HTTP_NOT_FOUND);
        } catch (QueryException $e) {
            return ResponseHelper::error(null, 'Terjadi kesalahan pada database: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, 'Gagal memperbarui buku: ' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            // Eksekusi proses penghapusan melalui service
            $this->bookService->deleteBook($id);

            // Kembalikan response sukses (data null karena ini aksi delete)
            return ResponseHelper::success(
                null,
                'Berhasil menghapus data buku',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Handle spesifik jika failOrFail() tidak menemukan data
            return ResponseHelper::error(
                null,
                'Data buku tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Handle jika terjadi error lain (misal: database down, foreign key constraint, dll)
            return ResponseHelper::error(
                null,
                'Gagal menghapus data buku: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR // 500 Internal Server Error
            );
        }
    }
}
