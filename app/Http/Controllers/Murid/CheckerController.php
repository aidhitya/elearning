<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $category, $mapel, Soal $soal)
    {
        $data = $request->all();
        if ($category !== strtolower($soal->kategori) || $mapel !== Str::slug($soal->mapel->nama)) {
            abort(404);
        }
        // return $data['jawaban'];
        $session_jwb = Session::get('jawaban');
        $session_soal = Session::get('soal');

        if (isset($data['jawaban'])) {
            $search_soal = array_search($data['soal'], $session_soal);
            $search_jwb = array_search($data['jawaban'], $session_jwb);
            if ($search_soal == false && $search_jwb == false) {
                session()->push('jawaban', $data['jawaban']);
                session()->push('soal', $data['soal']);
            } elseif ($search_soal == true && $search_jwb == false) {
                session()->pull('soal.' . $search_soal);
                session()->pull('jawaban.' . $search_soal);
                session()->push('jawaban', $data['jawaban']);
                session()->push('soal', $data['soal']);
            }
            $session_jwb = Session::get('jawaban');
            $session_soal = Session::get('soal');
        }

        $order = Session::get('by');
        $as = Session::get('sort');
        
        $soal->load('mapel:id,nama');

        $detail = $soal->detail_soal()->orderBy($order[0], $as[0])->with(['jawabans' => function ($query) use ($session_jwb, $order, $as){
            $query->whereIn('id', $session_jwb)->get();
        }])->get();

        return view('pages.siswa.soal', [
            'soal' => $soal,
            'detail' => $detail,
            'toggle' => 'set',
        ]);
    }
}
