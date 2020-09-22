<?php

namespace App\Imports;

use App\Models\Jawaban;
use App\Models\DetailSoal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SoalImport implements ToCollection, WithStartRow, WithChunkReading
{
    use Importable;

    protected $soalId;

    public function __construct(int $soalId)
    {
        $this->soalId = $soalId;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 75;
    }

    public function collection(Collection $rows)
    {
        $rows->toArray();

        foreach ($rows as $row) {

            $soal = DetailSoal::create([
                'soal_id' => $this->soalId,
                'soal' => $row[0],
                'randomize' => rand(1, 1000)
            ]);

            $jawaban = [
                $row[1], $row[2], $row[3], $row[4]
            ];

            for ($i = 0; $i < count($jawaban); $i++) {
                $kunci = 0;
                switch (strtoupper($row[5])) {
                    case 'A':
                        if ($i == 0) {
                            $kunci = 1;
                        }
                        break;

                    case 'B':
                        if ($i == 1) {
                            $kunci = 1;
                        }
                        break;

                    case 'C':
                        if ($i == 2) {
                            $kunci = 1;
                        }
                        break;

                    case 'D':
                        if ($i == 3) {
                            $kunci = 1;
                        }
                        break;

                    default:
                        $kunci = 0;
                        break;
                }

                $answer[] = [
                    'detail_soal_id' => $soal->id,
                    'jawaban' => $jawaban[$i],
                    'kunci' => $kunci,
                    'randomize' => rand(1, 1000)
                ];
            }

            Jawaban::insert($answer);
            $answer = null;
        }
    }
}
