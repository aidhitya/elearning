<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TugasRequest;
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

    public function create()
    {
        $kelas = Mapel::where('guru_id', Auth::id())->with('kelas')->get();
        return view('pages.guru.tugas.create',[
            'kelas' => $kelas
        ]);
    }

    public function store(TugasRequest $request)
    {
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

        return redirect()->back()->with('berhasil', 'Tugas Berhasil Dibuat');
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
        $data = $request->all();
        $tugas = Tugas::findOrFail($id);

        $mapel = Mapel::where([
            'guru_id' => Auth::id(),
            'kelas_id' => $data['kelas_id']
        ])->first();

        $data['mapel_id'] = $mapel->parent_id;

        $tugas->update($data);

        return redirect(route('tugas.index'))->with('berhasil', 'Tugas Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);
        $tugas->delete();

        return redirect(route('tugas.index'))->with('berhasil', 'Tugas Berhasil Dihapus');
    }
}
