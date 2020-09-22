<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\User;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Kelas::with(['wali_guru_kelas'])->orderBy('kelas')->orderBy('kode_kelas')->get();
        return view('pages.admin.kelas.kelas', [
            'kelas' => $kelas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = User::has('guru')->doesntHave('wali_kelas')->get();
        return view('pages.admin.kelas.tambah', [
            'guru' => $guru
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        $data = $request->all();

        Kelas::create($data);

        return redirect(route('kelas.create'))->with('berhasil', 'Kelas Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::with('wali_guru_kelas')->findOrFail($id);
        $guru = User::has('guru')->doesntHave('wali_kelas')->get();
        return view('pages.admin.kelas.edit', [
            'kelas' => $kelas,
            'guru' => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(KelasRequest $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $data = $request->all();
        $kelas->update($data);

        return redirect(route('kelas.index'))->with('berhasil', 'Kelas Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kelas::destroy($id);

        return back()->withErrors(['errors' => 'Kelas Berhasil Dihapus']);
    }
}
