<?php

namespace App\Services;

use App\Repositories\AntrianRepository;
use App\Repositories\BookRepository;
use App\Repositories\PeminjamanRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PeminjamanService
{
    protected $peminjamanRepo;
    protected $bookRepo;
    protected $antrianRepo;

    public function __construct(
        PeminjamanRepository $peminjamanRepo,
        BookRepository $bookRepo,
        AntrianRepository $antrianRepo
    ) {
        $this->peminjamanRepo = $peminjamanRepo;
        $this->bookRepo = $bookRepo;
        $this->antrianRepo = $antrianRepo;
    }

    /**
     * ALUR 1: TAMBAH PEMINJAMAN (Menangani Stok Ada vs Stok Kosong)
     */
    public function createPeminjamanAtauAntrian(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Kunci baris buku ini agar tidak berebut dengan request lain (Pencegahan Race Condition)
            $book = $this->bookRepo->lockForUpdate($data['book_id']);

            // 2. Cek Stok
            if ($book->stok_tersedia > 0) {
                // A. STOK TERSEDIA -> Masuk daftar pengambilan
                $this->bookRepo->decrementStok($book->id);

                $peminjaman = $this->peminjamanRepo->create([
                    'anggota_id' => $data['anggota_id'],
                    'book_id' => $data['book_id'],
                    'tanggal_booking' => now(), // Waktu admin menginput
                    'tanggal_pinjam' => $data['tanggal_pinjam'],
                    'tanggal_kembali' => $data['tanggal_kembali'], // Due date
                    'status' => 'MENUNGGU_DIAMBIL', // Implementasi saran #1 & #2
                    'denda' => 0
                ]);

                return [
                    'status' => 'success',
                    'type' => 'peminjaman',
                    'message' => 'Stok tersedia. Peminjaman berhasil dicatat dan masuk ke Daftar Pengambilan.',
                    'data' => $peminjaman
                ];
            } else {
                // B. STOK KOSONG -> Otomatis masuk antrian
                $antrian = $this->antrianRepo->create([
                    'anggota_id' => $data['anggota_id'],
                    'book_id' => $data['book_id'],
                    'tanggal_antri' => now(),
                    'status' => 'MENUNGGU'
                ]);

                return [
                    'status' => 'success',
                    'type' => 'antrian',
                    'message' => 'Stok buku habis. Siswa otomatis dimasukkan ke daftar antrian.',
                    'data' => $antrian
                ];
            }
        });
    }

    /**
     * ALUR 2: PENYELESAIAN PENGEMBALIAN & HITUNG DENDA
     */
    public function selesaikanPengembalian($peminjamanId)
    {
        return DB::transaction(function () use ($peminjamanId) {
            $peminjaman = $this->peminjamanRepo->findById($peminjamanId);

            if (!$peminjaman || $peminjaman->status === 'SELESAI') {
                throw new \Exception('Data peminjaman tidak valid atau sudah selesai.');
            }

            $waktuSekarang = now();
            $tenggatKembali = Carbon::parse($peminjaman->tanggal_kembali);
            $denda = 0;
            $statusAkhir = 'SELESAI'; // Atau 'KEMBALI' sesuai designmu

            // Hitung Denda (Rp 1000/hari) jika terlambat
            if ($waktuSekarang->greaterThan($tenggatKembali)) {
                $hariTerlambat = $waktuSekarang->diffInDays($tenggatKembali);
                $denda = $hariTerlambat * 1000;
            }

            // Update Peminjaman
            $this->peminjamanRepo->update($peminjamanId, [
                'tanggal_dikembalikan' => $waktuSekarang,
                'denda' => $denda,
                'status' => $statusAkhir
            ]);

            // Kembalikan Stok Buku
            $this->bookRepo->incrementStok($peminjaman->book_id);

            // OPTIONAL: Di sini kamu bisa memanggil antrianRepo untuk mengecek
            // apakah ada yang mengantri buku ini, lalu ubah status antriannya.

            return [
                'status' => 'success',
                'message' => 'Buku berhasil dikembalikan.',
                'denda_dibayar' => $denda
            ];
        });
    }

    /**
     * ALUR 3: PENGAMBILAN BUKU (Siswa datang mengambil buku)
     */
    public function konfirmasiPengambilan($peminjamanId)
    {
        $peminjaman = $this->peminjamanRepo->findById($peminjamanId);

        if ($peminjaman->status !== 'MENUNGGU_DIAMBIL') {
            throw new \Exception('Status buku tidak valid untuk diambil.');
        }

        $this->peminjamanRepo->update($peminjamanId, [
            'status' => 'DIPINJAM'
        ]);

        return ['status' => 'success', 'message' => 'Buku telah diserahkan ke siswa.'];
    }
}