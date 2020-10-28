<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Soal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::where('guru_id', Auth::id())->with('kelas')->get();

        $parent = $mapel->pluck('parent_id');
        $kelas = $mapel->pluck('kelas.kelas');
        $kelas_id = $mapel->pluck('kelas.id');

        $soal = Soal::where(function($q) use($kelas, $kelas_id, $parent){
            $q->where([
                'kelas' => $kelas,
                'mapel_id' => $parent
            ])->orWhere([
                'kelas_id' => $kelas_id,
                'mapel_id' => $parent
            ]);
        })->where(function($r){
            $r->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now());
        })->withCount('detail_soal')->get();
        // return $soal;
        return view('pages.guru.main',[
            'soal' => $soal
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuruRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        $data['foto'] = $request->file('foto')->store('images/guru', 'public');

        $user->guru()->create([
            'nip' => $data['nip'],
            'no_telp' => $data['no_telp'],
            'agama' => $data['agama'],
            'jenkel' => $data['jenkel'],
            'dob' => $data['dob'],
            'alamat' => $data['alamat'],
            'foto' => $data['foto'],
            'pendidikan' => $data['pendidikan']
        ]);

        return redirect(route('guru.create'))->with('berhasil', 'Guru Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //
    }
}
