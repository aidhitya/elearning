<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Checker;
use App\Models\Jawaban;
use App\Models\Nilai;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphTo;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade as PDF;
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
            return view('pages.siswa.nilai',[
                'checker' => $percobaan,
                'soal' => $soal
            ]);
        } elseif (count($percobaan) == 0) {
            $try = 1;
        }

        if (!$request->has('jawaban')) {
            $nilai = $soal->nilais()->create([
                'user_id' => Auth::user()->id,
                'nilai' => 0,
                'status' => 0,
                'keterangan' => 'TIDAK LULUS',
                'percobaan' => $try
            ]);

            session()->forget(['soal', 'jawaban', 'sort', 'by']);

            return view('pages.siswa.nilai', [
                'soal' => $soal,
                'nilai' => $nilai
            ]);
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

        $nilai = $soal->nilais()->create([
            'user_id' => Auth::user()->id,
            'nilai' => $score,
            'status' => $lulus,
            'keterangan' => $ket,
            'percobaan' => $try
        ]);

        Checker::whereNull('nilai_id')->update(['nilai_id' => $nilai->id]);

        session()->forget(['soal', 'jawaban', 'sort', 'by']);

        // return $nilai;

        return view('pages.siswa.nilai', [
            'soal' => $soal,
            'nilai' => $nilai
        ]);
    }

    public function nilaipdf($category, $mapel, Soal $soal, $try)
    {
        if ($category !== strtolower($soal->kategori) || $mapel !== Str::slug($soal->mapel->nama)) {
            abort(404);
        }

        $checker = Nilai::where([
            'user_id' => Auth::id(),
            'nilaiable_type' => 'App\Models\Soal',
            'nilaiable_id' => $soal->id,
            'percobaan' => $try
        ])->with(['nilaiable' => function(MorphTo $morphTo) {
            $morphTo->morphWithCount([Soal::class => ['detail_soal']]);
        }])->with(['checker.jawaban', 'murid.murid.kelas'])->first();

        $pdf = PDF::loadView('pages.siswa.nilai-pdf',[
            'checker' => $checker
        ])->setWarnings(false);

        // return view('pages.siswa.nilai-pdf',[
        //     'checker' => $checker
        // ]);
        
        return $pdf->download('Ujian_'.Auth::user()->murid->nis.'.pdf');
    }
}
