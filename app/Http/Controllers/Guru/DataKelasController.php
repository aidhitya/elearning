<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
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
}
