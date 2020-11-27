<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TugasRequest extends FormRequest
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
            'kelas_id' => 'required|integer|exists:kelas,id',
            'judul_tugas' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|max:2048',
        ];
    }

    public function attributes()
    {
        return [
            'kelas_id' => 'Kelas',
            'judul_tugas' => 'Judul',
            'deskripsi' => 'Deskripsi',
            'file' => 'File'
        ];
    }
}
