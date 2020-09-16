<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailSoalRequest extends FormRequest
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
        $rules = [
            'soal' => 'required|array',
            'soal.*' => 'required|string|distinct',
        ];

        for ($i = 1; $i <= count(request('soal')); $i++) {
            $rules['kunci_' . $i] = 'required|integer|in:1,2,3,4';
            $rules['gambar_' . $i] = 'image|max:2048';
            $rules['jawaban_' . $i . '_.*'] = 'required|distinct';
            $rules['jawaban_' . $i . '_'] = 'required|array';
        }

        return $rules;
    }
}
