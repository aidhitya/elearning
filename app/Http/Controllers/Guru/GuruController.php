<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Soal;
use App\Rules\CheckOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            ])->orWhere(function($t) use ($kelas_id, $parent){
                $t->where([
                    'kelas_id' => $kelas_id,
                    'mapel_id' => $parent,
                    'guru_id' => Auth::id()
                ]);
            });
        })->where(function($r){
            $r->where('mulai', '<=', Carbon::now())->where('selesai', '>=', Carbon::now());
        })->withCount('detail_soal')->get();
        // return $soal;
        return view('pages.guru.main',[
            'soal' => $soal,
            'mapel' => $mapel
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
        if (Auth::user()->guru->nip !== intval($nip)) {
            abort(404);
        }

        $guru = User::where('id', Auth::id())->with('guru')->first();

        return view('pages.guru.profile',[
            'guru' => $guru
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $guru->load('user');

        return view('pages.guru.edit-profile',[
            'guru' => $guru
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nip)
    {
        $user = Guru::where('nip', $nip)->with('user')->first();

        $this->validate($request, [
            'nama' => 'sometimes|required|string|max:50',
            'email' => 'sometimes|required|string|email|max:50|unique:users,email,' . $user->user->id,
            // Register
            'oldpass' => ['sometimes', 'required', new CheckOldPassword],
            'password' => 'sometimes|required|string|min:8|confirmed',
            'no_telp' => 'sometimes|required|min:9|max:14|unique:murids,no_telp,' . $user->user->id . ',user_id',
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

            return redirect(route('guru.show', $user->nip))->with('success', 'Password Berhasil Di Update');
        }

        $user->user()->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
        ]);

        if ($request->hasFile('foto')) {

            Storage::delete('public/' . $user->murid->foto);

            $data['foto'] = $request->file('foto')->store('images/guru', 'public');
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

        return redirect(route('guru.show', $user->nip))->with('success', 'Profile Berhasil Di Update');
    }
}
