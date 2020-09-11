<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Http\Requests\MapelRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\User;
use Illuminate\Http\Request;

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
        $kelas = Kelas::all();
        $guru = User::has('guru')->get();
        $mapel = Mapel::getParent()->get();
        return view('pages.admin.mapel.tambah', [
            'kelas' => $kelas,
            'guru' => $guru,
            'mapel' => $mapel
        ]);
    }

    public function store(MapelRequest $request)
    {
        $data =  $request->all();

        $exists = Mapel::where(function ($q) use ($data) {
            $q->where('kelas_id', $data['kelas'])->where('guru_id', $data['guru']); // Jika Kelas dan Guru sudah ada
        })->orWhere(function ($q) use ($data) {
            $q->where('kelas_id', $data['kelas'])->where('parent_id', $data['parent']);  // Jika Kelas dan Mapel sudah ada
        })->exists();

        if ($exists) {
            return redirect()->back()->withErrors('Data Sudah ada dalam kelas tersebut');
        }



        if ($request->has('parent') && $request->has('guru')) {
            $m = Mapel::getParent()->where('id', $data['parent'])->first();
            Mapel::create([
                'nama' => $m->nama,
                'parent_id' => $data['parent'],
                'kelas_id' => $data['kelas'],
                'guru_id' => $data['guru']
            ]);

            return redirect(route('mapel.create'))->with('berhasil', 'Kelas Berhasil Menambahkan Mapel');
        }
        Mapel::create($data);

        return redirect(route('mapel.create'))->with('berhasil', 'Mapel Baru Berhasil Ditambahkan');
    }
}
