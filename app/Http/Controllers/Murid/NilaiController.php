<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Checker;
use App\Models\Jawaban;
use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NilaiController extends Controller
{
    public function selesai(Request $request, Soal $soal)
    {
        $data = $request->all();

        $percobaan = Nilai::where([
            'user_id' => Auth::user()->id,
            'nilaiable_type' => 'App\Models\Soal',
            'nilaiable_id' => $soal->id
        ])->get();
        
        $try = 2;
        if (count($percobaan) >= 2) {
            return view('pages.siswa.nilai');
        } elseif (count($percobaan) == 0) {
            $try = 1;
        }


        $all = array_combine($data['soal'], $data['jawaban']);

        $n = 0;
        $count = count($all);
        foreach ($all as $question => $answer) {
            $check = Jawaban::findOrFail($answer);
            $status = 0;

            if ($check->kunci == 1) {
                $n += 1;
                $status = 1;
            }

            Checker::create([
                'murid_id' => Auth::id(),
                'soal_id' => $soal->id,
                'detail_soal_id' => $question,
                'jawaban_id' => $answer,
                'status' => $status,
                'percobaan' => $try
            ]);
        }
        $score =  ($n / $count) * 100;
        if ($score > 75) {
            $lulus = 1;
            $ket = 'LULUS';
        } else {
            $lulus = 0;
            $ket = 'TIDAK LULUS';
        }

        $nilai = $soal->nilai()->create([
            'user_id' => Auth::user()->id,
            'nilai' => $score,
            'status' => $lulus,
            'keterangan' => $ket,
            'percobaan' => $try
        ]);

        session()->forget(['soal', 'jawaban', 'sort', 'by']);

        // return $nilai;

        return view('pages.siswa.nilai', [
            'soal' => $soal,
            'nilai' => $nilai
        ]);
    }
}
