<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\Murid;
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
use Illuminate\Support\Facades\Auth;

class NilaiMapelExport implements FromQuery, WithMapping, WithStyles, WithCustomStartCell, WithColumnWidths
{
    use Exportable;
    protected $jTugas, $jSoal;

    public function soalKelas(int $id, int $kelas)
    {
        $this->id = $id;
        $this->kelas = $kelas;

        return $this;
    }

    public function query()
    {
        $k = Kelas::findOrFail($this->kelas);
        return Kelas::where('id', $k->id)->with([
            'murids',
            'mapels' => function($q) use($k) {
                $q->where([
                    'guru_id' => Auth::id(),
                    'parent_id' => $this->id
                ])->with([
                    'guru.guru',
                    'soals' => function($q) use($k){
                        $q->where(function($r) use($k){
                            $r->where([
                                'kelas_id' => $k->id,
                                'guru_id' => Auth::id()
                            ]);
                        })->orWhere('kelas', $k->kelas)->with('nilais.murid.murid');
                    }, 'tugas' => function($q) use($k){
                        $q->where([
                            'kelas_id' => $k->id,
                            'guru_id' => Auth::id()
                        ])->with('nilais.murid.murid');
                    }
                ]);
            }
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'B' => 15,
            'C' => 30,
            'D' => 5,
            'E' => 15,
            'F' => 15,
        ];
    }

    public function startCell(): string
    {
        return 'B2';
    }

    public function styles(Worksheet $sheet)
    {
        $cSoal = 'E';
        for ($i=1; $i < $this->jSoal; $i++) {
            $cSoal++;
        }

        $cTugas = $cSoal;
        $r = $cSoal;
        $r++;
        for ($i=0; $i < $this->jTugas; $i++) {
            $cTugas++;
        }

        $sheet->mergeCells('B2:F2')
        ->mergeCells('C3:E3')
        ->mergeCells('C4:E4')
        ->mergeCells('B6:B7')
        ->mergeCells('C6:C7')
        ->mergeCells('D6:D7')
        ->mergeCells('E6:'. $cSoal .'6')
        ->mergeCells($r . '6:'. $cTugas .'6');

        $kelas = Murid::where('kelas_id', $this->kelas)->count();
        $jumlahMurid = $kelas + 7;
        $row = [
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
            'B6:'.$cTugas.'6' => [
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
            'B7:B' . $jumlahMurid => $row,
            'C7:C' . $jumlahMurid => [
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
            'D7:D' . $jumlahMurid => $row,
            'E7:'. $cTugas . '7' => [
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
            'E7:'. $cTugas . $jumlahMurid => $row
        ];
    }

    public function addonStyle($jumlahTugas, $jumlahSoal)
    {
        $this->jTugas = count($jumlahTugas);
        $this->jSoal = count($jumlahSoal);
        return $this;
    }


    public function map($hasil): array
    {
        $this->addonStyle($hasil->mapels[0]->tugas, $hasil->mapels[0]->soals);
        $data = [
            [],
            ['', 'Kelas ' . $hasil->kelas . $hasil->kode_kelas],
            [],
            [],
        ];

        $head = ['NIS', 'NAMA', 'P/L', 'SOAL',];
        $subs = ['','',''];

        foreach ($hasil->mapels as $item) {
            $data[0] = ['REKAP NILAI ' . strtoupper($item->nama)];
            $data[2] = ['', $item->guru->nama . ' ' . $item->guru->guru->pendidikan];

            for ($i = 1; $i < count($item->soals); $i++) {
                $s = '';
                array_push($head, $s);
            }

            foreach ($item->soals as $f) {
                if ($f->kategori == 'Harian') {
                    $sub = 'H';
                } elseif ($f->kategori == 'UAS') {
                    $sub = 'UAS';
                } elseif ($f->kategori == 'UTS') {
                    $sub = 'UTS';
                } else {
                    $sub = 'Q';
                }

                array_push($subs, $sub);
            }

            for ($i = 1; $i <= count($item->tugas); $i++) {
                $sub = 'T' . $i;
                array_push($subs, $sub);
            }

        }

        array_push($head, 'TUGAS');
        array_push($data, $head);
        array_push($data, $subs);
        $nis = [];
        foreach ($hasil->murids as $murid) {
            $data[$murid->nis] = [
                $murid->nis,
                $murid->user->nama,
                $murid->jenkel == 'Laki-Laki' ? 'L' : 'P',
            ];

            $nis[$murid->nis] = $murid->nis;
        }

        foreach ($hasil->mapels as $mapel) {
            foreach ($mapel->soals as $item) {

                if (count($item->nilais) !== 0) {
                    $setSoal = [];
                    foreach ($item->nilais as $val) {
                        if (array_key_exists($val->murid->murid->nis, $data)) {

                            array_push($data[$val->murid->murid->nis], $val->nilai);
                            $setSoal[$val->murid->murid->nis] = $val->murid->murid->nis;

                        }
                    }

                    $nullNis = array_diff($nis, $setSoal);

                    foreach ($nullNis as $n) {
                        array_push($data[$n], '0');
                    } 

                } else {

                    foreach ($hasil->murids as $mur) {
                        array_push($data[$mur->nis], '0');
                    }
                }
            }

            foreach ($mapel->tugas as $t) {

                if (count($t->nilais) !== 0) {
                    $seTugas = [];
                    foreach ($t->nilais as $val) {
                        if (array_key_exists($val->murid->murid->nis, $data)) {
                            array_push($data[$val->murid->murid->nis], $val->nilai);
                            $seTugas[$val->murid->murid->nis] = $val->murid->murid->nis;
                        }
                    }

                    $nullNis = array_diff($nis, $seTugas);
                    foreach ($nullNis as $n) {
                        array_push($data[$n], '0');
                    }
                } else {

                    foreach ($hasil->murids as $mur) {
                        array_push($data[$mur->nis], '0');
                    }
                }
            }
        }
        
        return $data;
    }
}
