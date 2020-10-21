<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuridRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\Models\Pengumuman;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;

class MuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelas = Auth::user()->murid->kelas_id;
        
        $soal = function ($t) {
            $t->whereDoesntHave('nilais', function($que){
                $que->where('user_id', Auth::id());
            })->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now())->has('detail_soal');
        };

        $tugas = function ($q) {
            $q->whereDoesntHave('kumpultugas', function ($m) {
                $m->where('murid_id', Auth::id());
            })->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now());
        };

        $mapel = Kelas::where('id', $kelas)->with(['mapels' => function ($q) use ($soal, $tugas) {
            $q->withCount(['soals' => $soal])->whereHas('soals', $soal);
            $q->withCount(['tugas' => $tugas])->whereHas('tugas', $tugas);
        }])->first();

        $pengumuman = Pengumuman::whereHas('kelas', function($q) use ($kelas){
            $q->where('kelas_id', $kelas);
        })->get();
        // return $pengumuman;
        return view('pages.siswa.main',[
            'mapel' => $mapel,
            'pengumuman' => $pengumuman
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

        return redirect(route('siswa.create'))->with('success', 'Siswa Berhasil Dibuat');
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
