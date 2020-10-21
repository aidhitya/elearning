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
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{
    public function index()
    {
        $layout = 'admin';
        if (Auth::user()->role == 1) {
            $soal = Soal::where('guru_id', Auth::id())->with(['materi', 'mapel', 'author', 'speckelas'])->get();
            $layout = 'guru';
        } else {
            $soal = Soal::with(['materi', 'mapel', 'author', 'speckelas'])->get();
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
                $mat = explode('-', request('kelas_materi'));
                $k = Kelas::where('id', $mat[0])->first();

                $materi = Materi::where([
                    'kelas' => $k->kelas,
                    'mapel_id' => $mat[1],
                    'kelas_id' => null
                ])->orWhere(function ($q) use ($mat) {
                    $q->where([
                        'kelas_id' => $mat[0],
                        'guru_id' => Auth::id()
                    ])->get();
                })->get();

                return view('pages.umum.soal.includes.ajax-materi')->with([
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
        // Data Berada di View Composer
        return view('pages.umum.soal.tambah', [
            'layout' => 'admin'
        ]);
    }

    public function store(SoalRequest $request)
    {
        $this->validate($request, [
            'mulai' => 'required|after:now|date',
            'selesai' => 'required|date|after:mulai'
        ]);

        $data = $request->all();
        if (Auth::user()->role == 1) {
            $mat = explode('-', $data['kelas_materi']);
            $data['kelas_id'] = $mat[0];
            unset($data['kelas_materi']);
        }
        
        $data['guru_id'] = Auth::id();
        if (!$request->has('mapel_id')) {
            $mapel = Materi::where('id', $data['materi_id'])->first();

            $data['mapel_id'] = $mapel->mapel_id;
        }
        $soal = Soal::create($data);

        return redirect(route('soal.create'))->with('success', 'Soal ' . $soal->judul . ' berhasil dibuat');
    }

    public function show(Soal $soal)
    {
        $complete =  $soal->load([
            'author:id,nama',
            'speckelas:id,kelas,kode_kelas',
            'mapel:id,nama',
            'materi:id,judul',
            'detail_soal',
            'detail_soal.jawabans'
        ]);

        $layout = 'admin';

        if (Auth::user()->role == 1) {
            $layout = 'guru';
        }

        return view('pages.umum.soal.detail', [
            'layout' => $layout,
            'complete' => $complete
        ]);
    }

    public function edit(Soal $soal)
    {
        if ($soal->selesai < now()) {
            return redirect(route('soal.index'))->withErrors('Soal ' . $soal->judul . ' telah dikerjakan, tidak bisa diedit');
        }

        $soal->load(['speckelas', 'mapel', 'materi']);

        if (Auth::user()->role == 1) {
            $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();

            if (request()->ajax()) {

                $mat = explode('-', request('kelas_materi'));
                $k = Kelas::where('id', $mat[0])->first();

                $materi = Materi::where([
                    'kelas' => $k->kelas,
                    'mapel_id' => $mat[1],
                    'kelas_id' => null
                ])->orWhere(function ($q) use ($mat) {
                    $q->where([
                        'kelas_id' => $mat[0],
                        'guru_id' => Auth::id()
                    ])->get();
                })->get();

                return view('pages.umum.soal.includes.ajax-materi')->with([
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
        // Data Berada Di View Composer
        return view('pages.umum.soal.edit', [
            'soal' => $soal,
            'layout' => 'admin'
        ]);
    }

    public function update(SoalRequest $request, Soal $soal)
    {
        $this->validate($request, [
            'mulai' => 'required|date|before:selesai|after_or_equal:'.$soal->mulai,
            'selesai' => 'required|date|after:mulai|after:now'
        ]);
        
        if ($soal->mulai < now() && $soal->selesai < now()) {
            return redirect(route('soal.index'))->withErrors('Soal ' . $soal->judul . ' telah dikerjakam, tidak bisa diedit');
        }

        $data = $request->all();
        if (Auth::user()->role == 1) {
            $mat = explode('-', $data['kelas_materi']);
            $data['kelas_id'] = $mat[0];
            unset($data['kelas_materi']);
        }
        
        $data['guru_id'] = Auth::id();
        if (!$request->has('mapel_id')) {
            $mapel = Materi::where('id', $data['materi_id'])->first();

            $data['mapel_id'] = $mapel->mapel_id;
        }
        $soal->update($data);

        return redirect(route('soal.index'))->with('success', 'Soal ' . $soal->judul . ' berhasil diupdate');
    }

    public function destroy(Soal $soal)
    {
        if ($soal->nilais()->exists()) {
            return redirect(route('soal.index'))->with('errors', 'Soal Mempunyai Relasi');
        }
        $detail = DetailSoal::where('soal_id', $soal->id)->get();
        foreach ($detail as $value) {
            $jawaban = Jawaban::where('detail_soal_id', $value->id);
            $jawaban->delete();
            $value->delete();
        }
        $soal->delete();

        return redirect(route('soal.index'))->with('info', 'Soal berhasil dihapus');
    }
}
