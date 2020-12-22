<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;

class MuridImport implements ToCollection, WithStartRow, WithChunkReading
{
    use Importable;

    public function startRow(): int
    {
        return 7;
    }

    public function chunkSize(): int
    {
        return 75;
    }

    public function collection(Collection $rows)
    {
        $rows->toArray();

        foreach ($rows as $row) {

            $dob = Carbon::instance(Date::excelToDateTimeObject($row[7]));
            event(new Registered($user = User::create([
                'nama' => $row[1],
                'email' => $row[2],
                'password' => Hash::make(date_format($dob, 'Y-m-d')),
                'role' => 2
            ])));

            $user->murid()->create([
                'nis' => $row[0],
                'kelas_id' => $row[3],
                'no_telp' => $row[4],
                'agama' => ucwords(strtoupper($row[5])),
                'jenkel' => strtoupper($row[6]) == 'L' ? 'Laki-Laki' : 'Perempuan',
                'dob' => $dob,
                'alamat' => $row[8]
            ]);
        }
    }
}
