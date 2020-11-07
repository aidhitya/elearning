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
use App\Models\Tugas;
use App\Models\Pengumuman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class DataMuridController extends Controller
{
    public function pengumuman(Pengumuman $pengumuman, $judul)
    {
        if ($judul !== Str::slug($pengumuman->judul)) {
            abort(404);
        }
        $pengumuman->load('author.mengajarspec');
        return view('pages.umum.pengumuman.detail',[
            'pengumuman' => $pengumuman,
            'layout' => 'siswa'
        ]);
    }

    public function listmapel()
    {
        // Data Berada Di View Composer
        return view('pages.siswa.mapel.list');
    }

    public function listtugas()
    {
        // Data Berada Di View Composer
        return view('pages.siswa.tugas.list');
    }

    public function listsoal()
    {
        // Data Berada Di View Composer
        return view('pages.siswa.soal.list');
    }

    public function detailsoal(Mapel $mapel, $slug)
    {
        if (Str::slug($mapel->nama) !== $slug) {
            abort(404);
        }

        $kelas = Kelas::findOrFail(Auth::user()->murid->kelas_id);

        $soal = $mapel->load(['soals' => function($q) use ($kelas) {
            $q->where('kelas_id', $kelas->id)->orWhere('kelas', $kelas->kelas)->has('detail_soal')->get();
        }, 'soals.nilais' => function($que) {
            $que->where('user_id', Auth::id());
        }]);
        // return $soal;
        return view('pages.siswa.soal.detail', [
            'soal' => $soal
        ]);
    }

    public function detailtugas(Mapel $mapel, $slug)
    {
        if (Str::slug($mapel->nama) !== $slug) {
            abort(404);
        }

        $tugas = $mapel->load(['tugas' => function ($q) {
            $q->where('kelas_id', Auth::user()->murid->kelas_id)->get();
        }, 'tugas.kumpultugas' => function ($que) {
            $que->where('murid_id', Auth::id());
        }, 'tugas.nilais' => function($q){
            $q->where('user_id', Auth::id());
        }]);
        // return $tugas;

        return view('pages.siswa.tugas.detail',[
            'tugas' => $tugas
        ]);
    }

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
        }, 'guru.guru:user_id,pendidikan'])->firstOrFail();

        // $s->whereDate('mulai', '<=', Carbon::now())->whereTime('mulai', '<', Carbon::now());
        // $e->whereDate('selesai', '>=', Carbon::now())->whereTime('selesai', '>', Carbon::now());

        $soal = Soal::where(function($que){
            $que->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now());
        })->whereHas('nilais', function ($q) {
            $q->where('user_id', Auth::id());
        }, '<', 2)->has('detail_soal')->with('mapel:id,nama')->where(function($q) use ($userKelas, $search){
            $q->where([
                'kelas' => $userKelas->kelas,
                'mapel_id' => $search->parent_id
            ])->orWhere(function($query) use ($userKelas, $search){
                $query->where([
                    'kelas_id' => $userKelas->id,
                    'mapel_id' => $search->parent_id
                ]);
            });
        })->get();

        $tugas = Tugas::where([
            'kelas_id' => $userKelas->id,
            'mapel_id' => $search->parent_id
        ])->where(function ($que) {
            $que->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now());
        })->whereDoesntHave('kumpultugas', function($m){
            $m->where('murid_id', Auth::id());
        })->get();
        
        return view('pages.siswa.mapel.mapel', [
            'search' => $search,
            'soal' => $soal,
            'tugas' => $tugas
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
