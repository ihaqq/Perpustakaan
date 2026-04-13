<?php
namespace App\Http\Controllers\API;

use App\Helpers\PaginationHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanStoreRequest;
use App\Http\Resources\BookResource;
use App\Services\PeminjamanService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeminjamanController extends Controller
{
    protected $peminjamanService;

    public function __construct(PeminjamanService $peminjamanService)
    {
        $this->peminjamanService = $peminjamanService;
    }
    public function index(Request $request)
    {
        try {
            $params = $request->only([
                'search',
                'kategori',
                'genre_id',
                'tahun',
                'stok',
                'per_page',
                'sort_order'
            ]);

            $query = $this->bookService->getBooks($params);

            $result = PaginationHelper::paginate(
                $query,
                $params['per_page'] ?? 10
            );

            return ResponseHelper::success(
                [
                    'books' => BookResource::collection(collect($result['data'])),
                    'meta' => $result['meta']
                ],
                'Berhasil mengambil data buku'
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil data buku ' . $th->getMessage()
            );
        }
    }
    public function store(PeminjamanStoreRequest $request)
    {
        try {
            $result = $this->peminjamanService->createPeminjamanAtauAntrian($request->validated());

            // Mengembalikan status 201 (Created)
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'data' => $result['data'],
                'type' => $result['type'] // Frontend bisa pakai info ini untuk redirect halaman
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    public function ambilBuku($id)
    {
        try {
            $result = $this->peminjamanService->konfirmasiPengambilan($id);
            return response()->json(['success' => true, 'message' => $result['message']], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }

    public function kembalikanBuku($id)
    {
        try {
            $result = $this->peminjamanService->selesaikanPengembalian($id);
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'denda' => $result['denda_dibayar']
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
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

    public function totalBooks(Request $request)
    {
        try {

            $total = $this->bookService->getTotalBooks();

            return ResponseHelper::success(
                ['total' => $total],
                'Berhasil mengambil total buku',
                Response::HTTP_OK
            );

        } catch (\Throwable $th) {
            return ResponseHelper::error(
                null,
                'Gagal mengambil total buku ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}