<?php

namespace App\Http\Controllers\Murid;

use App\Http\Controllers\Controller;
use App\Http\Requests\MuridRequest;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Murid;
use App\Models\Pengumuman;
use App\Rules\CheckOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

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
            $q->withCount(['tugas' => $tugas])->orWhereHas('tugas', $tugas);
        }])->first();

        $pengumuman = Pengumuman::whereHas('kelas', function($q) use ($kelas){
            $q->where('kelas_id', $kelas);
        })->get();
        // return $mapel;
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
    public function show($nis)
    {
        if (Auth::user()->murid->nis !== intval($nis)) {
            abort(404);
        }

        $murid = User::where('id', Auth::id())->with('murid.kelas')->first();

        return view('pages.siswa.profile',[
            'murid' => $murid
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function edit(Murid $murid)
    {
        $murid->load('user');

        return view('pages.siswa.edit-profile',[
            'murid' => $murid
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Murid  $murid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nis)
    {
        $user = Murid::where('nis', $nis)->with('user')->first();

        $this->validate($request, [
            'nama' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|string|email|max:50|unique:users,email,'. $user->user->id,
            // Register
            'oldpass' => ['sometimes', 'required', new CheckOldPassword],
            'password' => 'sometimes|required|string|min:8|confirmed',
            'no_telp' => 'sometimes|required|min:9|max:14|unique:murids,no_telp,'. $user->user->id . ',user_id',
            'agama' => 'sometimes|required|string|in:Islam,Protestan,Katolik,Hindu,Buddha,Konghucu',
            'jenkel' => 'sometimes|required|string|in:Laki-Laki,Perempuan',
            'dob' => 'sometimes|required|date',
            'alamat' => 'sometimes|required',
            'foto' => 'nullable|image|max:1024'
        ]);

        $data = $request->all();

        if ($request->has('password')) {

            $user->user()->update([
                'password' => Hash::make($data['password'])
            ]);

            return redirect(route('murid.show', $user->nis))->with('success', 'Password Berhasil Di Update');
        }

        $user->user()->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
        ]);

        if ($request->hasFile('foto')) {

            Storage::delete('public/' . $user->murid->foto);

            $data['foto'] = $request->file('foto')->store('images/murid', 'public');
            $user->update([
                'no_telp' => $data['no_telp'],
                'agama' => $data['agama'],
                'jenkel' => $data['jenkel'],
                'dob' => $data['dob'],
                'alamat' => $data['alamat'],
                'foto' => $data['foto']
            ]);

        } else {

            $user->update([
                'no_telp' => $data['no_telp'],
                'agama' => $data['agama'],
                'jenkel' => $data['jenkel'],
                'dob' => $data['dob'],
                'alamat' => $data['alamat']
            ]);
        }

        return redirect(route('murid.show', $user->nis))->with('success', 'Profile Berhasil Di Update');
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
