<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Pastikan true karena belum ada auth
    }

    public function rules(): array
    {
        return [
            'anggota_id'        => 'required|uuid|exists:anggota,id',
            'book_id'           => 'required|uuid|exists:books,id',
            'tanggal_pinjam'    => 'required|date',
            'tanggal_kembali'   => 'required|date|after_or_equal:tanggal_pinjam',
        ];
    }

    public function messages(): array
    {
        return [
            'anggota_id.required'   => 'ID anggota wajib diisi.',
            'anggota_id.uuid'       => 'Format ID anggota tidak valid.',
            'anggota_id.exists'     => 'Anggota dengan ID tersebut tidak ditemukan.',

            'book_id.required'      => 'ID buku wajib diisi.',
            'book_id.uuid'          => 'Format ID buku tidak valid.',
            'book_id.exists'        => 'Buku dengan ID tersebut tidak ditemukan.',

            'tanggal_pinjam.required'           => 'Tanggal pinjam wajib diisi.',
            'tanggal_pinjam.date'               => 'Tanggal pinjam harus berupa tanggal yang valid.',

            'tanggal_kembali.required'          => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.date'              => 'Tanggal kembali harus berupa tanggal yang valid.',
            'tanggal_kembali.after_or_equal'    => 'Tanggal kembali harus sama dengan atau setelah tanggal pinjam.',
        ];
    }
}