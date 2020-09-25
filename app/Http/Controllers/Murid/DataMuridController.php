<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class DataMuridController extends Controller
{
    public function mapel($mapel)
    {
        $m = $mapel;
        if (strpos($mapel, '-') !== false) {
            $map = explode('-', $mapel);
             $m = ucwords(implode(' ',$map));
        }

        $userKelas = Kelas::select('id', 'kelas')->find(Auth::user()->murid->kelas_id);

        $search = Mapel::where([
            'kelas_id' => $userKelas->id,
            'nama' => $m
        ])->with(['materis' => function ($q) use ($userKelas) {
            $q->where('kelas', $userKelas->kelas)->orWhere('kelas_id', $userKelas->id);
        }, 'guru.guru:user_id,pendidikan'])->first();

        // $search = Mapel::getParent()->where('nama', $m)->with(['child' => function($q) use ($userKelas){
        //     $q->where('kelas_id', $userKelas->id)->with(['guru', ]);
        // }])->first();
        // return $search;
        return view('pages.siswa.mapel', [
            'search' => $search
        ]);
    }

    public function materi($mapel, Materi $materi)
    {
        return view('pages.siswa.materi',[
            'materi' => $materi
        ]);
    }
}
