<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Models\DetailSoal;
use Illuminate\Http\Request;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

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

        $soal = Soal::whereHas('nilais', function($q) {
            $q->where('user_id', Auth::id());
        }, '<', 2)->with('mapel:id,nama')->where([
            'kelas' => $userKelas->kelas,
            'mapel_id' => $search->parent_id
        ])->orWhere(function($q) use ($userKelas, $search){
            $q->where([
                'kelas_id' => $userKelas->id,
                'mapel_id' => $search->parent_id
            ]);
        })->has('detail_soal')->get();
        
        return view('pages.siswa.mapel', [
            'search' => $search,
            'soal' => $soal
        ]);
    }

    public function materi($mapel, Materi $materi)
    {
        $materi->load('mapel:id,nama');
        if ($mapel !== Str::slug($materi->mapel->nama)) {
            abort(404);
        }
        
        return view('pages.siswa.materi',[
            'materi' => $materi
        ]);
    }
}
