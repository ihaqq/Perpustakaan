<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'nullable|uuid|exists:categories,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachment' => 'nullable|image|max:2048',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i',
            'completion_date' => 'nullable|date|after_or_equal:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.uuid' => 'Format kategori tidak valid.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'title.required' => 'Judul harus diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'content.required' => 'Konten harus diisi.',
            'content.string' => 'Konten harus berupa teks.',
            'attachment.image' => 'Lampiran harus berupa file gambar.',
            'attachment.max' => 'Ukuran gambar maksimal 2MB.',
            'location.string' => 'Lokasi harus berupa teks.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
            'start_date.date' => 'Tanggal mulai harus berupa tanggal yang valid.',
            'time.date_format' => 'Format waktu harus jam:menit (contoh: 14:00).',
            'completion_date.date' => 'Tanggal selesai harus berupa tanggal yang valid.',
            'completion_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
        ];
    }
}
