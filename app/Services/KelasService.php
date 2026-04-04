<?php
namespace App\Services;

use App\Repositories\BookRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KelasService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    public function getBooks(array $params)
    {
        $query = $this->bookRepository->getBooksWithQuery($params);
        
        return $query;
    }
    public function getBookById($id)
    {
        return $this->bookRepository->find($id);
    }

    public function createBook(array $data)
    {
        return DB::transaction(function () use ($data) {

        // Logic untuk generate kode buku
        // ambil data buku terakhir dari database
        $lastBook    = $this->bookRepository->getLastBook();
        $lastNumber  = 0;

        // ekstrak angka dari data buku sebelumnya 
        if ($lastBook && preg_match('/^BK-(\d+)$/', $lastBook->kode_buku, $matches)) {
            $lastNumber = (int) $matches[1];
        }

        // Tambahkan 1 dan format menjadi 4 digit (contoh: 1 -> 0001, 15 -> 0015)
        $newNumber = $lastNumber + 1;
        $data['kode_buku'] = 'BK-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT); // BISA UBAH PANJANG KODE BUKU PADA BAGIAN INI

            // Cek apakah ada file 'cover' yang diunggah
            if (isset($data['cover']) && $data['cover'] instanceof UploadedFile) {
                // Simpan file ke folder 'public/covers' di storage
                // Mengembalikan path file, contoh: 'coverBuku/namafile.jpg'
                $coverPath = $data['cover']->store('coverBuku', 'public');
                
                // Ganti value object file di dalam array dengan path string-nya
                $data['cover'] = $coverPath;
            }

            // Teruskan data yang sudah siap (beserta path gambar) ke repository
            return $this->bookRepository->create($data);
        });
    }
    public function updateBook($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            // 1. Ambil data buku lama untuk mengecek path gambar lamanya
            $oldBook = $this->bookRepository->findById($id);

            // logic untuk tidak meng update data kode_buku
            unset($data['kode_buku']);

            // 2. Cek apakah user mengunggah file 'cover' baru
            if (isset($data['cover']) && $data['cover'] instanceof UploadedFile) {
                
                // Hapus cover lama dari storage jika file-nya benar-benar ada
                if ($oldBook->cover && Storage::disk('public')->exists($oldBook->cover)) {
                    Storage::disk('public')->delete($oldBook->cover);
                }

                // Simpan file baru ke folder 'coverBuku' di storage
                $coverPath = $data['cover']->store('coverBuku', 'public');
                
                // Ganti value array dengan path file yang baru
                $data['cover'] = $coverPath;
            }

            // 3. Teruskan data ke repository untuk di-update ke database
            return $this->bookRepository->update($id, $data);
        });
    }
    public function deleteBook($id)
    {
        // 1. Ambil data buku HANYA untuk mendapatkan path file cover-nya
        $book = $this->bookRepository->findById($id);

        // 2. Lakukan proses hapus data di database dalam transaction
        // (Berjaga-jaga jika di masa depan buku ini memiliki banyak relasi tabel yang harus ikut dihapus)
        DB::transaction(function () use ($id) {
            $this->bookRepository->delete($id);
        });

        // 3. JIKA database berhasil dihapus, hapus file cover dari storage
        // Pengecekan dilakukan agar tidak terjadi error jika data lama tidak punya cover
        if ($book->cover && Storage::disk('public')->exists($book->cover)) {
            Storage::disk('public')->delete($book->cover);
        }

        return true;
    }
}