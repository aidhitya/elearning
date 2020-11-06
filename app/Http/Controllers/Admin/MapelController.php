<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Http\Requests\MapelRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::getParent()->get();
        $detail = Mapel::getChildren()->get();

        return view('pages.admin.mapel.mapel', [
            'mapel' => $mapel,
            'detail' => $detail
        ]);
    }

    public function create()
    {
        // DATA BERADA DI VIEW COMPOSERS
        return view('pages.admin.mapel.tambah');
    }

    public function store(MapelRequest $request)
    {
        $data =  $request->all();

        if ($request->has('parent') && $request->has('guru')) {

            $exists = Mapel::where(function ($q) use ($data) {
                $q->where('kelas_id', $data['kelas'])->where('guru_id', $data['guru']); // Jika Kelas dan Guru sudah ada
            })->orWhere(function ($q) use ($data) {
                $q->where('kelas_id', $data['kelas'])->where('parent_id', $data['parent']);  // Jika Kelas dan Mapel sudah ada
            })->exists();

            if ($exists) {
                return redirect()->back()->withErrors('Data Sudah ada dalam kelas tersebut');
            }

            $m = Mapel::getParent()->where('id', $data['parent'])->first();
            Mapel::create([
                'nama' => $m->nama,
                'parent_id' => $data['parent'],
                'kelas_id' => $data['kelas'],
                'guru_id' => $data['guru']
            ]);

            return redirect(route('mapel.create'))->with('toast_success', 'Kelas Berhasil Menambahkan Mapel');
        }
        Mapel::create($data);

        return redirect(route('mapel.create'))->with('toast_success', 'Mapel Baru Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $edit = Mapel::findOrFail($id);

        if ($edit->parent_id !== null) {

            $edit->load(['kelas', 'guru']);
            
            // DATA BERADA DI VIEW COMPOSERS
            return view('pages.admin.mapel.edit', [
                'edit' => $edit
            ]);
        }

        // Edit Mapel Parent
        return view('pages.admin.mapel.edit', [
            'edit' => $edit
        ]);
    }

    public function update(MapelRequest $request, $id)
    {
        $data = $request->all();

        $mapel = Mapel::findOrFail($id);

        if ($mapel->parent_id == null) {

            $this->validate($request, [
                'nama' => [
                    'sometimes',
                    'required',
                    'string',
                    Rule::unique('mapels')->whereNull('parent_id')->ignore($id),
                ]
            ]);

            $mapel->update($data);

            $child = Mapel::where('parent_id', $id)->get();

            if ($child) {
                foreach ($child as $item) {
                    $item->update([
                        'nama' => $data['nama']
                    ]);
                }
            }
        } else {

            $new = Mapel::where('id', $data['parent'])->first();
            $mapel->update([
                'nama' => $new->nama,
                'parent_id' => $data['parent'],
                'kelas_id' => $data['kelas'],
                'guru_id' => $data['guru']
            ]);
        }

        return redirect(route('mapel.index'))->with('toast_success', 'Mapel Berhasil Diupdate');
    }

    public function destroy($id)
    {
        $del = Mapel::findOrFail($id);
        // return $del;
        if ($del->child()->exists() || $del->materi()->exists() || $del->materis()->exists()) {
            return redirect(route('mapel.index'))->with('errors', 'Mapel Mempunyai Relasi');
        } 

        $del->delete();

        return redirect(route('mapel.index'))->with('info', "Data Mapel Berhasil Dihapus");
    }
}
