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

class GuruImport implements ToCollection, WithStartRow, WithChunkReading
{
    use Importable;

    public function startRow(): int
    {
        return 6;
    }

    public function chunkSize(): int
    {
        return 75;
    }

    public function collection(Collection $rows)
    {
        $rows->toArray();

        foreach ($rows as $row) {

            $dob = Carbon::instance(Date::excelToDateTimeObject($row[6]));
            $user = User::create([
                'nama' => $row[1],
                'email' => $row[2],
                'password' => Hash::make(date_format($dob, 'Y-m-d')),
                'role' => 1
            ]);

            $user->guru()->create([
                'nip' => $row[0],
                'no_telp' => $row[3],
                'agama' => ucwords(strtoupper($row[4])),
                'jenkel' => strtoupper($row[5]) == 'L' ? 'Laki-Laki' : 'Perempuan',
                'dob' => $dob,
                'alamat' => $row[8],
                'pendidikan' => $row[7]
            ]);
        }
    }
}
