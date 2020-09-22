<?php

namespace App\Http\Controllers;

use App\Http\Requests\MateriRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        $mapel = Mapel::getParent()->orderBy('nama')->get();
        $materi = Materi::with(['guru', 'kelas_spec', 'mapel'])->get();
        // return $materi;
        return view('pages.umum.materi.admin.mapel', [
            'kelas' => $kelas,
            'mapel' => $mapel,
            'materi' => $materi
        ]);
    }

    public function create()
    {
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        $mapel = Mapel::getParent()->orderBy('nama')->get();
        return view('pages.umum.materi.admin.tambah', [
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }

    public function store(MateriRequest $request)
    {
        $this->validate($request, [
            'file' => 'required|mimetypes:application/pdf|max:5120'
        ]);

        $data = $request->all();

        $data['file'] = $request->file('file')->store('materi/kelas/' . $data['kelas'] . '/' . $data['mapel'], 'public');

        Materi::create([
            'kelas' => $data['kelas'],
            'mapel_id' => $data['mapel'],
            'judul' => $data['judul'],
            'file' => $data['file'],
            'pertemuan' => $data['pertemuan'],
            'author' => Auth::id(),
            'keterangan' => $data['keterangan']
        ]);

        return redirect(route('materi.create'))->with('berhasil', 'Materi Baru Untuk Kelas ' . $data['kelas'] . ' Berhasil Ditambahkan');
    }

    public function edit(Materi $materi)
    {
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        $mapel = Mapel::getParent()->orderBy('nama')->get();
        return view('pages.umum.materi.admin.edit', [
            'kelas' => $kelas,
            'mapel' => $mapel,
            'materi' => $materi
        ]);
    }

    public function update(MateriRequest $request, Materi $materi)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {

            $data['file'] = $request->file('file')->store('materi/kelas/' . $data['kelas'] . '/' . $data['mapel'], 'public');
            Storage::delete('public/' . $materi->file);
            $materi->update([
                'kelas' => $data['kelas'],
                'mapel_id' => $data['mapel'],
                'judul' => $data['judul'],
                'file' => $data['file'],
                'pertemuan' => $data['pertemuan'],
                'author' => Auth::id(),
                'keterangan' => $data['keterangan']
            ]);
        } else {

            $materi->update([
                'kelas' => $data['kelas'],
                'mapel_id' => $data['mapel'],
                'judul' => $data['judul'],
                'pertemuan' => $data['pertemuan'],
                'author' => Auth::id(),
                'keterangan' => $data['keterangan']
            ]);
        }

        return redirect(route('materi.index'))->with('berhasil', 'Materi Baru Untuk Kelas ' . $data['kelas'] . ' Berhasil Diupdate');
    }

    public function destroy(Materi $materi)
    {
        // Storage::delete('public/' . $materi->file);
        $materi->delete();

        return redirect(route('materi.index'))->with('berhasil', 'Materi Berhasil Dihapus');
    }
}
