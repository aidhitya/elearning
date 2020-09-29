<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\Nilai;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class MengerjakanController extends Controller
{
    public function soal($category, $mapel, Soal $soal)
    {
        // session()->forget('soal');
        // session()->forget('jawaban');
        // session()->forget('sort');
        // session()->forget('by');

        // URL
        if ($category !== strtolower($soal->kategori) || $mapel !== Str::slug($soal->mapel->nama)) {
            abort(404);
        }

        $percobaan = Nilai::where([
            'user_id' => Auth::user()->id,
            'nilaiable_type' => 'App\Models\Soal',
            'nilaiable_id' => $soal->id
        ])->get();

        if (count($percobaan) >= 2) {
            return view('pages.siswa.nilai');
        }

        $soal->load('mapel:id,nama');

        // SESSION ORDERBY SOAL
        if (!Session::exists(['soal', 'jawaban'])) {
            session()->push('soal', 0);
            session()->push('jawaban', 0);

            $by = array('randomize', 'id', 'isi');
            $b = array_rand($by);
            session()->push('by', $by[$b]);

            $sort = array('asc', 'desc');
            $s = array_rand($sort);
            session()->push('sort', $sort[$s]);
        }
        $order = Session::get('by');
        $as = Session::get('sort');

        $detail = $soal->detail_soal()->orderBy($order[0], $as[0])->with(['jawabans' => function ($q) {
            $q->inRandomOrder()->get();
        }])->paginate(1);

        // return $soal;
        return view('pages.siswa.soal', [
            'soal' => $soal,
            'detail' => $detail,
            'toggle' => 'null', // untuk hidden toggle navbar
        ]);
    }

    public function slide(Request $request, $category, $mapel, Soal $soal)
    {
        if ($category !== strtolower($soal->kategori) || $mapel !== Str::slug($soal->mapel->nama)) {
            abort(404);
        }

        $data = $request->all();

        $soal = Session::get('soal');
        $jawaban = Session::get('jawaban');

        if (isset($data['jawaban'])) {
            $search_soal = array_search($data['soal'], $soal);
            $search_jwb = array_search($data['jawaban'], $jawaban);
            if ($search_soal == false && $search_jwb == false) {
                session()->push('jawaban', $data['jawaban']);
                session()->push('soal', $data['soal']);
            } elseif ($search_soal == true && $search_jwb == false) {
                session()->pull('soal.'. $search_soal);
                session()->pull('jawaban.'. $search_soal);
                session()->push('jawaban', $data['jawaban']);
                session()->push('soal', $data['soal']);
            }
        }

        return redirect($request->fullUrl());
    }
}
