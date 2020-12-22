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
            'role' => ['required', 'integer', 'in:2'],
            // Register
            'nis' => 'required|digits:5|integer|unique:murids,nis',
            'kelas' => 'required|integer|exists:kelas,id',
            'no_telp' => 'required|min:10|max:14|unique:murids,no_telp',
            'agama' => 'required|string|in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Konghucu',
            'jenkel' => 'required|string|in:Laki-Laki,Perempuan',
            'dob' => 'required|date|before:now',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:1024'
        ];
    }

    public function attributes()
    {
        return [
            'nama' => 'Nama',
            'email' => 'Email',
            'role' => 'Role',
            'nis' => 'NIS',
            'kelas' => 'Kelas',
            'no_telp' => 'Nomor Handphone',
            'agama' => 'Agama',
            'jenkel' => 'Jenis Kelamin',
            'dob' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'foto' => 'Foto',
        ];
    }
}
