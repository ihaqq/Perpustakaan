<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper; 
use Symfony\Component\HttpFoundation\Response;

class BookUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Mendapatkan ID buku dari parameter rute. 
        $bookId = $this->route('id') ?? $this->route('book');

        return [
            'genres_id'      => 'nullable|uuid|exists:genres,id', 
            'judul'          => 'required|string|max:255',
            'pengarang'      => 'required|string|max:255',
            'penerbit'       => 'required|string|max:255',
            'stok_total'     => 'required|integer|min:0',
            'stok_tersedia'  => 'integer|min:0',
            'kondisi_awal'   => 'string|max:255',
            'tahun_terbit'   => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'bahasa'         => 'required|string|max:255',
            'lokasi_rak'     => 'required|string|max:255',
            'jumlah_halaman' => 'required|integer|min:1', 
            'sinopsis'       => 'required|string', 
            'cover'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            // Messages untuk genres_id
            'genres_id.uuid'     => 'Format ID genre tidak valid.',
            'genres_id.exists'   => 'Genre yang dipilih tidak ditemukan di sistem.',

            // Messages untuk kode_buku
            'kode_buku.string'   => 'Kode buku harus berupa teks.',
            'kode_buku.max'      => 'Kode buku maksimal 255 karakter.',
            'kode_buku.unique'   => 'Kode buku ini sudah terdaftar. Silakan gunakan kode lain.',

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
            'stok_total.required' => 'Stok total wajib diisi.',
            'stok_total.integer'  => 'Stok total harus berupa angka.',
            'stok_total.min'      => 'Stok total tidak boleh kurang dari 0.',

            // Messages untuk stok tersedia
            'stok_tersedia.integer' => 'Stok tersedia harus berupa angka.',
            'stok_tersedia.min'     => 'Stok tersedia tidak boleh kurang dari 0.',

            // Messages untuk kondisi_awal
            'kondisi_awal.string'   => 'Kondisi awal buku harus berupa teks.',
            'kondisi_awal.max'      => 'Kondisi awal buku maksimal 255 karakter.',

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

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ResponseHelper::error(
                $validator->errors(),
                'Validasi gagal. Silakan periksa kembali data Anda.',
                Response::HTTP_UNPROCESSABLE_ENTITY 
            )
        );
    }
}