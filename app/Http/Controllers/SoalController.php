<?php

namespace App\Http\Controllers;

use App\Http\Requests\SoalRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 1) {
            $soal = Soal::where('author', Auth::id())->with(['materi', 'mapel', 'pembuat', 'speckelas'])->get();
        } else {
            $soal = Soal::with(['materi', 'mapel', 'pembuat', 'speckelas'])->get();
        }
        // return $soal;
        return view('pages.umum.soal.main', [
            'soal' => $soal
        ]);
    }

    public function create()
    {
        // GURU
        if (Auth::user()->role == 1) {
            $kelas = Mapel::where('guru_id', Auth::id())->get();

            if (request()->ajax()) {

                $k = Kelas::where('id', request('kelas_id'))->first();

                $materi = Materi::where('kelas', $k->kelas)->where(function ($q) {
                    $q->WhereNull('kelas_id')->orWhere('kelas_id', request('kelas_id'));
                })->get();

                return view('pages.umum.soal.materi')->with([
                    'layout' => 'guru',
                    'materi' => $materi
                ])->render();
            }

            $materi = [];
            return view('pages.umum.soal.tambah', [
                'layout' => 'guru',
                'kelas' => $kelas,
                'materi' => $materi
            ]);
        }

        // ADMIN
        $mapel = Mapel::getParent()->get();
        $kelas = Kelas::select('kelas')->distinct()->get();
        return view('pages.umum.soal.tambah', [
            'layout' => 'admin',
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }

    public function store(SoalRequest $request)
    {
        $data = $request->all();
        $data['author'] = Auth::id();
        if (!$request->has('mapel_id')) {
            $mapel = Materi::where('id', $data['materi_id'])->first();

            $data['mapel_id'] = $mapel->id;
        }
        $soal = Soal::create($data);

        return redirect(route('soal.create'))->with('berhasil', 'Soal ' . $soal->judul . ' berhasil dibuat');
    }
}
