<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TugasRequest;
use App\Models\KumpulTugas;
use App\Models\Mapel;
use App\Models\Tugas;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::where('guru_id', Auth::id())->with(['kelas', 'mapel'])->get();

        return view('pages.guru.tugas.tugas',[
            'tugas' => $tugas
        ]);
    }

    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->load(['kumpultugas.murid.nilais' => function($q) use ($tugas){
            $q->where([
                'nilaiable_id' => $tugas->id,
                'nilaiable_type' => 'App\Models\Tugas'
                ])->get();
        }]);
        // return $tugas;
        return view('pages.guru.tugas.detail',[
            'tugas' => $tugas
        ]);
    }

    public function create()
    {
        $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();
        return view('pages.guru.tugas.create',[
            'kelas' => $kelas
        ]);
    }

    public function store(TugasRequest $request)
    {
        $this->validate($request,[
            'mulai' => 'required|after:now|date',
            'selesai' => 'required|date|after:mulai'
        ]);

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('tugas/'.$data['kelas_id'], 'public');
        }

        $data['guru_id'] = Auth::id();

        $mapel = Mapel::where([
            'guru_id' => $data['guru_id'],
            'kelas_id' => $data['kelas_id']
            ])->first();

        $data['mapel_id'] = $mapel->parent_id;

        Tugas::create($data);

        return redirect()->back()->with('toast_success', 'Tugas Berhasil Dibuat');
    }

    public function edit($id)
    {
        $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();
        $tugas = Tugas::findOrFail($id);
        $tugas->load(['kelas', 'mapel']);

        return view('pages.guru.tugas.edit',[
            'kelas' => $kelas,
            'tugas' => $tugas
        ]);
    }

    public function update(TugasRequest $request, $id)
    {
        $this->validate($request, [
            'mulai' => 'required|date|before:selesai',
            'selesai' => 'required|date|after:mulai|after:now'
        ]);

        $data = $request->all();
        $tugas = Tugas::findOrFail($id);

        $mapel = Mapel::where([
            'guru_id' => Auth::id(),
            'kelas_id' => $data['kelas_id']
        ])->first();

        $data['mapel_id'] = $mapel->parent_id;

        $tugas->update($data);

        return redirect(route('tugas.index'))->with('toast_success', 'Tugas Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        if ($tugas->kumpultugas()->exists()) {
            return redirect(route('tugas.index'))->with('errors', 'Tugas Mempunyai Relasi');
        }
        $tugas->delete();

        return redirect(route('tugas.index'))->with('info', 'Tugas Berhasil Dihapus');
    }

    public function nilai(Request $request, $id)
    {
        $this->validate($request,[
            'murid' => 'required|integer|exists:users,id',
            'nilai' => 'required|integer|digits_between:0,100',
            'keterangan' => 'nullable|string'
        ]);

        $data = $request->all();
        $tugas = Tugas::findOrFail($id);

        $tugas->nilais()->updateOrCreate([
            'user_id' => $data['murid']
        ], [
            'nilai' => $data['nilai'],
            'status' => $data['nilai'] >= 75 ? 1 : 0,
            'keterangan' => $data['keterangan'],
        ]);

        return redirect(route('tugas.show',  $id))->with('success', 'Nilai Tugas Berhasil Diinput');
    }
}
