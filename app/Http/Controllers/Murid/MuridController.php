<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuridRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userKelas = Kelas::select('id', 'kelas')->find(Auth::user()->murid->kelas_id);
        // $mapel = Kelas::where('id', $userKelas->id)->with(['mapels' => function($q) use ($userKelas){
        //     $q->withCount(['materis' => function($query) use ($userKelas) {
        //         $query->where('kelas', $userKelas->kelas)->orWhere('kelas_id', $userKelas->id);
        //     }]);
        // }])->get();
        $mapel = Kelas::where('id', Auth::user()->murid->kelas_id)->with('mapels')->first();
        
        return view('pages.siswa.main',[
            'mapel' => $mapel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.siswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MuridRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role']
        ]);

        $data['foto'] = $request->file('foto')->store('images/murid', 'public');

        $user->murid()->create([
            'nis' => $data['nis'],
            'no_telp' => $data['no_telp'],
            'agama' => $data['agama'],
            'jenkel' => $data['jenkel'],
            'dob' => $data['dob'],
            'alamat' => $data['alamat'],
            'foto' => $data['foto']
        ]);

        return redirect(route('siswa.create'))->with('berhasil', 'Siswa Berhasil Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function show(Murid $murid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function edit(Murid $murid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Murid $murid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Murid $murid)
    {
        //
    }
}
