<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MapelRequest extends FormRequest
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
            'parent' => 'sometimes|required|integer|exists:mapels,id',
            'guru' => 'sometimes|required|integer|exists:users,id',
            'kelas' => 'sometimes|required|integer|exists:kelas,id'
        ];
    }

    public function attributes()
    {
        return [
            'parent' => 'Mata Pelajaran',
            'guru' => 'Guru',
            'kelas' => 'Kelas'
        ];
    }
}
