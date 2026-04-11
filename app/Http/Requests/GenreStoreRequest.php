<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan Anda mengubah ini menjadi pemeriksaan otorisasi yang sesuai jika diperlukan
        // Misalnya: return auth()->check();
        return true; 
    }

    public function rules(): array
    {
        return [
            'nama_genre'     => 'required|string|max:20',
            'kategori_buku'  => 'required|in:Fiksi,Non Fiksi',
            'deskripsi'      => 'nullable|string|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            // Messages untuk nama_genre
            'nama_genre.required' => 'Nama genre wajib diisi.',
            'nama_genre.string'   => 'Nama genre harus berupa teks.',
            'nama_genre.max'      => 'Nama genre maksimal 20 karakter.',

            // Messages untuk kategori_buku
            'kategori_buku.required' => 'Kategori buku wajib diisi.',
            'kategori_buku.in'       => 'Kategori buku harus salah satu dari: Fiksi, Non-Fiksi.',

            // Messages untuk deskripsi
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max'    => 'Deskripsi maksimal 150 karakter.',
        ];
    }
}