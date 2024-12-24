<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AjxPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_karyawan' => 'required',
            'id_perusahaan' => 'required',
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
            'id_lokasi' =>  'required',
        ];
    }
}
