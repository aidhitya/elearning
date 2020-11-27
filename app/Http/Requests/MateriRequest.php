<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriRequest extends FormRequest
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
            'kelas' => 'required|integer|exists:kelas,kelas',
            'kelas_id' => 'sometimes|required|integer|exists:kelas,id',
            'mapel' => 'sometimes|required|integer|exists:mapels,id',
            'judul' => 'required|string',
            'pertemuan' => 'sometimes|required|integer',
            'keterangan' => 'nullable|string'
        ];
    }

    public function attributes()
    {
        return [
            'kelas' => 'Kelas Umum',
            'kelas_id' => 'Kelas',
            'mapel' => 'Mata Pelajaran',
            'judul' => 'Judul',
            'pertemuan' => 'Pertemuan',
            'keterangan' => 'Keterangan'
        ];
    }
}
