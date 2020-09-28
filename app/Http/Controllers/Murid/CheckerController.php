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
        if ($category !== strtolower($soal->kategori) || $mapel !== Str::slug($soal->mapel->nama)) {
            abort(404);
        }

        $session_jwb = Session::get('jawaban');
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
