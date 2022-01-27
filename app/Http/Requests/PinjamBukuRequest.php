<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinjamBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'buku_id'=>'required|integer|exists:buku,id',
            'anggota_id'=>'required|integer|exists:anggota,id',
            'admin_id'=>'integer|exists:admin,id',
            'tanggal_pinjam'=>'date|required',
            'tanggal_pengembalian'=>'date|required|after_or_equal:tanggal_pinjam'
        ];
    }

    public function messages()
    {
        return [
            'buku_id.required'=>'Buku wajib wajib diisi',
            'anggota_id.required'=>'Anggota wajib diisi',
            'tanggal_pinjam.required'=>'Tanggal Pinjam wajib diisi',
            'tanggal_pengembalian.required'=>'Tanggal pengembalian wajib diisi dan harus setelah tanggal pinjam'
        ];
    }
}
