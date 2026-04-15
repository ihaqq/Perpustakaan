<?php
namespace App\Http\Controllers\API;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\AnggotaResource;
use App\Http\Resources\BookResource;
use App\Services\AnggotaService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnggotaController extends Controller
{
    protected $anggotaService;
    
    public function __construct(AnggotaService $anggotaService)
    {
        $this->anggotaService = $anggotaService;
    }
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'status',
                'kelas_id',
                'jurusan',
                'kelas',
                'kategori',
                'per_page',
                'sort_order'
            ]);

            $query = $this->anggotaService->getAnggota($params);

            $result = PaginationHelper::paginate(
                $query,
                $params['per_page'] ?? 10
            );

            return ResponseHelper::success(
                [
                    'anggota' => AnggotaResource::collection(collect($result['data'])),
                    'meta' => $result['meta']
                ],
                'Berhasil mengambil data anggota'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data anggota' . $th->getMessage()
            );
        }
    }
    public function store(BookStoreRequest $request)
    {
        try {
            // Mengambil SEMUA data yang sudah tervalidasi di BookStoreRequest
            $data = $request->validated();

            // Panggil service untuk memproses pembuatan buku dan upload file
            $book = $this->anggotaService->createBook($data);

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
            // Ambil data anggota melalui service
            $anggota = $this->anggotaService->getAnggotaById($id);

            // Return response sukses, format data menggunakan Resource agar konsisten
            return ResponseHelper::success(
                new AnggotaResource($anggota),
                'Berhasil mengambil detail anggota',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Tangkap error jika ID anggota tidak ada di database
            return ResponseHelper::error(
                null,
                'Data anggota tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Tangkap error sistem lainnya
            return ResponseHelper::error(
                null,
                'Gagal mengambil detail anggota: ' . $th->getMessage(),
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
            $book = $this->anggotaService->updateBook($id, $data);

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
            $this->anggotaService->deleteAnggota($id);

            // Kembalikan response sukses (data null karena ini aksi delete)
            return ResponseHelper::success(
                null,
                'Berhasil menghapus data anggota',
                Response::HTTP_OK // 200 OK
            );

        } catch (ModelNotFoundException $e) {
            // Handle spesifik jika failOrFail() tidak menemukan data
            return ResponseHelper::error(
                null,
                'Data anggota tidak ditemukan',
                Response::HTTP_NOT_FOUND // 404 Not Found
            );

        } catch (\Throwable $th) {
            // Handle jika terjadi error lain (misal: database down, foreign key constraint, dll)
            return ResponseHelper::error(
                null,
                'Gagal menghapus data anggota: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR // 500 Internal Server Error
            );
        }
    }

    public function totalAnggota(Request $request)
    {
        try {

            $total = $this->anggotaService->getTotalAnggota();

            return ResponseHelper::success(
                ['total' => $total],
                'Berhasil mengambil total anggota',
                Response::HTTP_OK
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil total anggota ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
