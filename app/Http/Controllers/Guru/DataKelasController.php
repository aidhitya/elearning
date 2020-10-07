<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\User;
use App\Models\Soal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKelasController extends Controller
{
    public function index($kelas)
    {
        $set = array_pad(explode('-', $kelas), 2, null);
        if (count($set) > 2 || $set[1] == null) {
            abort(404);
        }
        $kelas = Kelas::select('id')->where(['kelas' => $set[0], 'kode_kelas' => $set[1]])->first();

        if ($kelas) {

            $data = Mapel::with(['kelas' => function ($q) use ($set) {
                $q->where(['kelas' => $set[0], 'kode_kelas' => $set[1]])->with(['murids.user:id,nama', 'wali_kelas.guru:user_id,pendidikan'])->first();
            }])->where(['guru_id' => Auth::id(), 'kelas_id' => $kelas->id])->first();

            return view('pages.guru.kelas.kelas', [
                'data' => $data
            ]);
        }

        abort(404);
    }

    public function soal()
    {

        $kelas = Kelas::where('guru_id', Auth::id());
        $pluck = $kelas->pluck('kelas', 'id')->toArray();
        $soals = $kelas->with(['mapels' => function($q) use ($pluck) {
            $q->with('kelas.wali_kelas.guru')->where('guru_id', Auth::id())->withCount(['soals as soal_umum' => function ($q) use ($pluck) {
                $q->whereIn('kelas', array_values($pluck));
            }, 'soals as soal_kelas' => function ($q) use ($pluck) {
                $q->whereIn('kelas_id', array_keys($pluck));
            }]);
        }])->get();
        // return $soals;
        return view('pages.guru.detail.soal',[
            'soals' => $soals
        ]);
    }

    public function detailsoal($kelas, $m, Mapel $mapel)
    {
        $kel = array_pad(explode('-', $kelas), 2, null);
        if ($m !== Str::slug($mapel->nama) || $mapel->parent_id == null || count($kel) > 2) {
            abort(404);
        }

        $kelas = Kelas::where(['kelas' => $kel[0], 'kode_kelas' => $kel[1]])->first();

        if ($kelas) {

            $map = function($q) use ($mapel, $kelas) {
                $q->withCount(['nilais' => function($q) use ($kelas) {
                    $q->where('percobaan', 1)->whereHas('murid.murid', function ($q) use ($kelas) {
                        $q->where('kelas_id', $kelas->id)->with('murid');
                    });;
                }])->where('mapel_id', $mapel->parent_id);
            };

            $data = $kelas->load(['soal.mapel', 'soals.mapel', 'soal' => $map, 'soals' => $map]);
            // return $data;
            return view('pages.guru.detail.list',[
                'data' => $data
            ]);
        }

        abort(404);
    }

    public function detailmurid(Kelas $kelas, Soal $soal, $judul)
    {
        if ($judul !== Str::slug($soal->judul)) {
            abort(404);
        }

        $nilai =  $soal->load(['speckelas', 'nilais'  => function ($q) use ($kelas) {
            $q->whereHas('murid.murid', function($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id)->with('murid');
            });
        }]);

         return view('pages.guru.detail.nilai',[
             'nilai' => $nilai
         ]);
    }
}
