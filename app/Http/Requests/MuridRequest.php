<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MuridRequest extends FormRequest
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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:1'],
            // Register
            'nis' => 'required|digits:9|integer|unique:murids,nis',
            'no_telp' => 'required|min:10|max:14|unique:murids,no_telp',
            'agama' => 'required|string|in:Islam,Protestan,Katolik,Hindu,Buddha,Konghucu',
            'jenkel' => 'required|string|in:Laki-Laki,Perempuan',
            'dob' => 'required|date',
            'alamat' => 'required',
            'foto' => 'required|image'
        ];
    }
}
