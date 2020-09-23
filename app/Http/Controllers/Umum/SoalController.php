<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Http\Requests\SoalRequest;
use App\Models\DetailSoal;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\Models\Soal;
use App\Models\Jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SoalController extends Controller
{
    public function index()
    {
        $layout = 'admin';
        if (Auth::user()->role == 1) {
            $soal = Soal::where('author', Auth::id())->with(['materi', 'mapel', 'pembuat', 'speckelas'])->get();
            $layout = 'guru';
        } else {
            $soal = Soal::with(['materi', 'mapel', 'pembuat', 'speckelas'])->get();
        }
        // return $soal;
        return view('pages.umum.soal.main', [
            'layout' => $layout,
            'soal' => $soal
        ]);
    }

    public function create()
    {
        // GURU
        if (Auth::user()->role == 1) {
            $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();

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
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
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

            $data['mapel_id'] = $mapel->mapel_id;
        }
        $soal = Soal::create($data);

        return redirect(route('soal.create'))->with('berhasil', 'Soal ' . $soal->judul . ' berhasil dibuat');
    }

    public function show(Soal $soal)
    {
        $complete =  $soal->load([
            'pembuat:id,nama',
            'speckelas:id,kelas,kode_kelas',
            'mapel:id,nama',
            'materi:id,judul',
            'detail_soal',
            'detail_soal.jawabans'
        ]);

        $layout = 'admin';

        if (Auth::user()->role = 1) {
            $layout = 'guru';
        }

        return view('pages.umum.soal.detail', [
            'layout' => $layout,
            'complete' => $complete
        ]);
    }

    public function edit(Soal $soal)
    {
        if ($soal->mulai < now()) {
            return redirect(route('soal.index'))->withErrors('Soal ' . $soal->judul . ' telah dikerjakan, tidak bisa diedit');
        }

        $soal->load(['speckelas', 'mapel', 'materi']);

        if (Auth::user()->role == 1) {
            $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();

            if (request()->ajax()) {

                $k = Kelas::where('id', request('kelas_id'))->first();

                $materi = Materi::where('kelas', $k->kelas)->where(function ($q) {
                    $q->WhereNull('kelas_id')->orWhere('kelas_id', request('kelas_id'));
                })->get();

                return view('pages.umum.soal.edit-materi')->with([
                    'layout' => 'guru',
                    'materi' => $materi
                ])->render();
            }

            $materi = [];
            return view('pages.umum.soal.edit', [
                'soal' => $soal,
                'layout' => 'guru',
                'kelas' => $kelas,
                'materi' => $materi
            ]);
        }

        // ADMIN
        $mapel = Mapel::getParent()->get();
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        return view('pages.umum.soal.edit', [
            'soal' => $soal,
            'layout' => 'admin',
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }

    public function update(SoalRequest $request, Soal $soal)
    {
        if ($soal->mulai < now()) {
            return redirect(route('soal.index'))->withErrors('Soal ' . $soal->judul . ' telah dikerjakam, tidak bisa diedit');
        }

        $data = $request->all();
        $data['author'] = Auth::id();
        if (!$request->has('mapel_id')) {
            $mapel = Materi::where('id', $data['materi_id'])->first();

            $data['mapel_id'] = $mapel->mapel_id;
        }
        $soal->update($data);

        return redirect(route('soal.index'))->with('berhasil', 'Soal ' . $soal->judul . ' berhasil diupdate');
    }

    public function destroy(Soal $soal)
    {
        $detail = DetailSoal::where('soal_id', $soal->id)->get();
        foreach ($detail as $value) {
            $jawaban = Jawaban::where('detail_soal_id', $value->id);
            $jawaban->delete();
            $value->delete();
        }
        $soal->delete();

        return redirect(route('soal.index'))->with('berhasil', 'Soal berhasil dihapus');
    }
}
