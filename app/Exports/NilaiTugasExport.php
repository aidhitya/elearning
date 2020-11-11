<?php

namespace App\Exports;

use App\Models\Murid;
use App\Models\Tugas;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class NilaiTugasExport implements FromQuery, WithMapping, WithStyles, WithCustomStartCell, WithColumnWidths
{
    use Exportable;

    public function soalKelas(int $id, int $kelas)
    {
        $this->id = $id;
        $this->kelas = $kelas;

        return $this;
    }

    public function query()
    {
        return Tugas::where('id', $this->id)->with(['mapel', 'nilais.murid.murid' => function ($q) {
            $q->where('kelas_id', $this->kelas)->with('kelas');
        }]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 15,
            'C' => 30,
            'D' => 5,
            'E' => 15,
            'F' => 15
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function collectArray($nilai)
    {
        $item = [];
        foreach ($nilai as $item) {
            $item = $item;
        }

        return $nilai;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('B2:F2')->mergeCells('C3:E3')->mergeCells('C4:E4');
        $kelas = Murid::where('kelas_id', $this->kelas)->count();
        $set = $kelas + 7;
        $all = [
            'font' => [
                'size' => 12
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => [
                        'rgb' => '000000'
                    ]
                ]
            ]
        ];

        return [

            2 => [
                'font' => [
                    'bold' => true,
                    'size' => 20
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            3 => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            4 => [
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ],
            'B6:F6' => [
                'fill' =>  [
                    'fillType' => Fill::FILL_SOLID,
                    'color' => [
                        'rgb' => 'D8D8D8'
                    ]
                ],
                'font' => [
                    'size' => 12
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ]
                ]
            ],
            'B7:B' . $set => $all,
            'C7:C' . $set => [
                'font' => [
                    'size' => 12
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => [
                            'rgb' => '000000'
                        ]
                    ]
                ]
            ],
            'D7:D' . $set => $all,
            'E7:E' . $set => $all,
            'F7:F' . $set => $all
        ];
    }

    public function map($hasil): array
    {
        $data = [
            [
                strtoupper($hasil->judul_tugas)
            ],
            [
                '', 'Kelas ' . $hasil->nilais[0]->murid->murid->kelas->kelas . $hasil->nilais[0]->murid->murid->kelas->kode_kelas
            ],
            [
                '', $hasil->mapel->nama
            ],
            [],
            [
                'NIS', 'NAMA', 'P/L', 'NILAI', 'STATUS'
            ]
        ];


        foreach ($hasil->nilais as $value) {
            $nilai = [
                $value->murid->murid->nis,
                strtoupper($value->murid->nama),
                $value->murid->murid->jenkel == 'Laki-Laki' ? 'L' : 'P',
                $value->nilai,
                $value->status == 1 ? 'LULUS' : 'TIDAK LULUS'
            ];
            array_push($data, $nilai);
        }

        return $data;
    }
}