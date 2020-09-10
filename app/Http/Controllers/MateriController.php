<?php

namespace App\Http\Controllers;

use App\Http\Requests\MateriRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;

class MateriController extends Controller
{
    public function create()
    {
        $kelas = Kelas::select('kelas')->distinct()->get();
        $mapel = Mapel::getParent()->get();
        return view('pages.admin.materi.tambah', [
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }

    public function store(MateriRequest $request)
    {
        $data = $request->all();

        $data['file'] = $request->file('file')->store('materi/kelas/' . $data['kelas'] . '/' . $data['mapel'], 'public');

        Materi::create([
            'kelas' => $data['kelas'],
            'mapel_id' => $data['mapel'],
            'judul' => $data['judul'],
            'file' => $data['file'],
            'author' => Auth::id(),
            'keterangan' => $data['keterangan']
        ]);

        return redirect(route('materi.create'))->with('berhasil', 'Materi Baru Untuk Kelas' . $data['kelas'] . ' Berhasil Ditambahkan');
    }
}
