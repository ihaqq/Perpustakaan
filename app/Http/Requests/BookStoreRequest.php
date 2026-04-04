<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'genres_id'      => 'nullable|uuid|exists:genres,id', 
            'judul'          => 'required|string|max:255',
            'pengarang'      => 'required|string|max:255',
            'penerbit'       => 'required|string|max:255',
            'stok'           => 'required|integer|min:0', 
            'tahun_terbit'   => 'required|integer|digits:4|min:1899|max:' . (date('Y') + 1), 
            'bahasa'         => 'required|string|max:255',
            'lokasi_rak'     => 'required|string|max:255',
            'jumlah_halaman' => 'required|integer|min:1', 
            'sinopsis'       => 'required|string', 
            'cover'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            // Messages untuk genres_id
            'genres_id.uuid'     => 'Format ID genre tidak valid.',
            'genres_id.exists'   => 'Genre yang dipilih tidak ditemukan di sistem.',

            // Messages untuk judul
            'judul.required'     => 'Judul buku wajib diisi.',
            'judul.string'       => 'Judul buku harus berupa teks.',
            'judul.max'          => 'Judul buku maksimal 255 karakter.',

            // Messages untuk pengarang
            'pengarang.required' => 'Nama pengarang wajib diisi.',
            'pengarang.string'   => 'Nama pengarang harus berupa teks.',
            'pengarang.max'      => 'Nama pengarang maksimal 255 karakter.',

            // Messages untuk penerbit
            'penerbit.required'  => 'Nama penerbit wajib diisi.',
            'penerbit.string'    => 'Nama penerbit harus berupa teks.',
            'penerbit.max'       => 'Nama penerbit maksimal 255 karakter.',

            // Messages untuk stok
            'stok.required'      => 'Stok buku wajib diisi.',
            'stok.integer'       => 'Stok buku harus berupa angka.',
            'stok.min'           => 'Stok buku tidak boleh kurang dari 0.',

            // Messages untuk tahun_terbit
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer'  => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.digits'   => 'Tahun terbit harus terdiri dari 4 digit angka.',
            'tahun_terbit.min'      => 'Tahun terbit minimal tahun 1900.',
            'tahun_terbit.max'      => 'Tahun terbit tidak boleh melebihi tahun depan.',

            // Messages untuk bahasa
            'bahasa.required'    => 'Bahasa buku wajib diisi.',
            'bahasa.string'      => 'Bahasa buku harus berupa teks.',
            'bahasa.max'         => 'Bahasa buku maksimal 255 karakter.',

            // Messages untuk lokasi_rak
            'lokasi_rak.required'=> 'Lokasi rak wajib diisi.',
            'lokasi_rak.string'  => 'Lokasi rak harus berupa teks.',
            'lokasi_rak.max'     => 'Lokasi rak maksimal 255 karakter.',

            // Messages untuk jumlah_halaman
            'jumlah_halaman.required' => 'Jumlah halaman wajib diisi.',
            'jumlah_halaman.integer'  => 'Jumlah halaman harus berupa angka.',
            'jumlah_halaman.min'      => 'Jumlah halaman minimal harus 1.',

            // Messages untuk sinopsis
            'sinopsis.required'  => 'Sinopsis buku wajib diisi.',
            'sinopsis.string'    => 'Sinopsis harus berupa teks.',

            // Messages untuk cover
            'cover.image'        => 'File cover harus berupa gambar.',
            'cover.mimes'        => 'Cover harus memiliki format: jpeg, png, atau jpg.',
            'cover.max'          => 'Ukuran cover maksimal 2MB (2048 KB).',
        ];
    }
}