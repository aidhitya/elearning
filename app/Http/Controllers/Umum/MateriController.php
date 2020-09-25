<?php

namespace App\Http\Controllers\Umum;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriRequest;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Materi;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 1) {
            $materi = User::select('id')->where('id', Auth::id())->with(['mengajar.kelas' => function ($q) {
                $q->with('wali_kelas:id,nama')->withCount(['materi', 'materis'])->orderBy('kelas')->get();
            }])->first();
            // return $materi;
            return view('pages.umum.materi.guru.main', [
                'materi' => $materi
            ]);
        }

        $materi = Materi::with(['guru', 'kelas_spec', 'mapel'])->get();
        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        $mapel = Mapel::getParent()->orderBy('nama')->get();

        return view('pages.umum.materi.admin.mapel', [
            'kelas' => $kelas,
            'mapel' => $mapel,
            'materi' => $materi
        ]);
    }

    public function create($kel = null)
    {

        if (!is_null($kel) && Auth::user()->role == 1) {

            $set = array_pad(explode('-', $kel), 2, null);
            if (count($set) > 2 || $set[1] == null) {
                abort(404);
            }

            $kelas = Kelas::where(['kelas' => $set[0], 'kode_kelas' => $set[1]])->first();
            $mapel = Mapel::select('parent_id', 'nama')->where(['kelas_id' => $kelas->id, 'guru_id' => Auth::id()])->first();

            return view('pages.umum.materi.guru.tambah', [
                'kelas' => $kelas,
                'mapel' => $mapel
            ]);
        } elseif ((is_null($kel) && Auth::user()->role == 1) || (!is_null($kel) && Auth::user()->role == 0)) {
            abort(404);
        }

        $kelas = Kelas::select('kelas')->distinct()->orderBy('kelas')->get();
        $mapel = Mapel::getParent()->orderBy('nama')->get();
        return view('pages.umum.materi.admin.tambah', [
            'kelas' => $kelas,
            'mapel' => $mapel
        ]);
    }

    public function store(MateriRequest $request)
    {
        if (Auth::user()->role == 0) {

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


        $this->validate($request, [
            'file' => 'required_without:url|mimetypes:application/pdf|max:5120',
            'url' => 'required_without:file|active_url|url|nullable'
        ]);
        $data = $request->all();

        if ($request->hasFile('file')) {

            $data['file'] = $request->file('file')->store('materi/kelas/' . $data['kelas'] . '/' . $data['kelas_id'] . '/' . $data['mapel'], 'public');
        } else {
            $data['file'] = null;
        }

        Materi::create([
            'kelas' => $data['kelas'],
            'kelas_id' => $data['kelas_id'],
            'mapel_id' => $data['mapel'],
            'judul' => $data['judul'],
            'url' => $data['url'],
            'file' => $data['file'],
            'author' => Auth::id(),
            'keterangan' => $data['keterangan']
        ]);

        return redirect(route('materi.create', $data['kelas'] . '-' . $data['kode']))->with('berhasil', 'Materi Baru Kelas ' . $data['kelas'] . $data['kode'] . ' Berhasil Ditambahkan');
    }

    public function show(Kelas $kelas, Materi $materi = null)
    {
        $detail =  $kelas->load(['materi', 'materis']);
        // return $detail;
        return view('pages.umum.materi.guru.list', [
            'detail' => $detail
        ]);
    }

    public function edit(Materi $materi)
    {
        if (Auth::user()->role == 1) {
            $materi->load(['kelas_spec', 'mapel:id,nama']);
            // return $materi;
            return view('pages.umum.materi.guru.edit', [
                'materi' => $materi
            ]);
        }

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

        if (Auth::user()->role == 1) {

            $this->validate($request, [
                'file' => 'required_without:url|mimetypes:application/pdf|max:5120',
                'url' => 'required_without:file|active_url|url'
            ]);

            if ($request->hasFile('file')) {

                $data['file'] = $request->file('file')->store('materi/kelas/' . $data['kelas'] . '/' . $data['mapel'], 'public');
                Storage::delete('public/' . $materi->file);
                $materi->update([
                    'judul' => $data['judul'],
                    'url' => $data['url'],
                    'file' => $data['file'],
                    'keterangan' => $data['keterangan']
                ]);
            } else {

                $materi->update([
                    'judul' => $data['judul'],
                    'url' => $data['url'],
                    'keterangan' => $data['keterangan']
                ]);
            }

            return redirect(route('materi.show', $data['kelas']))->with('berhasil', 'Materi Untuk Kelas ' . $materi->kelas . $data['kode'] . ' Berhasil Diupdate');
        }

        // ADMIN

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

        if (Auth::user()->role == 1) {
            return redirect()->back()->with('berhasil', 'Materi Berhasil Dihapus');
        }

        return redirect(route('materi.index'))->with('berhasil', 'Materi Berhasil Dihapus');
    }
}
