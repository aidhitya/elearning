<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Http\Requests\MuridRequest;
use App\Models\Checker;
use App\Models\Kelas;
use App\Models\KumpulTugas;
use App\Models\Nilai;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Rules\CheckOldPassword;

class UsersController extends Controller
{
    public function status(User $user)
    {
        if ($user->status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }

        $user->update([
            'status' => $status
        ]);

        return redirect()->back()->with('toast_success', 'Status Updated');
    }

    public function userdelete(User $user)
    {
        $nilai = Nilai::where('user_id', $user->id)->get();

        foreach ($nilai as  $item) {
            $check = Checker::where('nilai_id', $item->id);
            $check->delete();
            $item->delete();
        }

        $tug = KumpulTugas::where('murid_id', $user->id);
        $tug->delete();

        $user->murid()->delete();
        $user->delete();

        return redirect()->back()->with('success', 'User Beserta Relasinya Terhapus');
    }

    public function allsiswa()
    {
        $siswa = User::has('murid')->with('murid.kelas')->get();

        $nonkelas = User::whereHas('murid', function ($q) {
            $q->doesntHave('kelas');
        })->count();

        $nonactive = User::has('murid')->where('status', false)->count();

        $kelas = Kelas::all();

        return view('pages.admin.users.siswa', [
            'siswa' => $siswa,
            'nonkelas' => $nonkelas,
            'nonactive' => $nonactive,
            'kelas' => $kelas
        ]);
    }

    public function allguru()
    {
        $guru = User::has('guru')->with('mengajar.kelas', 'guru')->get();

        // return $guru;
        return view('pages.admin.users.guru',[
            'guru' => $guru
        ]);
    }

    public function tambahsiswa()
    {
        $kelas = Kelas::all();
        return view('pages.admin.users.tambah-siswa',[
            'kelas' => $kelas
        ]);
    }

    public function tambahguru()
    {
        return view('pages.admin.users.tambah-guru');
    }

    public function editsiswa(Request $request)
    {
        $data = $request->all();

        $this->validate($request,[
            'id' => 'required|integer',
            'nis' => 'required|integer|unique:murids,nis,'. $data['id'] .',user_id',
            'kelas' => 'required|integer|exists:kelas,id'
        ]);


        $siswa = User::findOrFail($data['id']);

        $siswa->murid()->update([
            'nis' => $data['nis'],
            'kelas_id' => $data['kelas']
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function editguru(Request $request)
    {
        $data = $request->all();

        $this->validate($request, [
            'id' => 'required|integer',
            'nip' => 'required|integer|unique:gurus,nip,' . $data['id'] . ',user_id',
        ]);


        $siswa = User::findOrFail($data['id']);

        $siswa->guru()->update([
            'nip' => $data['nip']
        ]);

        return redirect()->back()->with('success', 'Data Berhasil Diupdate');
    }

    public function storesiswa(MuridRequest $request)
    {
        $data = $request->all();

        event(new Registered($user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['dob']),
            'role' => $data['role']
        ])));

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/murid', 'public');
        } else {
            $data['foto'] = null;
        }

        $user->murid()->create([
            'nis' => $data['nis'],
            'kelas_id' => $data['kelas'],
            'no_telp' => $data['no_telp'],
            'agama' => $data['agama'],
            'jenkel' => $data['jenkel'],
            'dob' => $data['dob'],
            'alamat' => $data['alamat'],
            'foto' => $data['foto']
        ]);

        return redirect()->route('tambah.siswa')->with('success', 'Siswa Berhasil Dibuat');
    }

    public function storeguru(GuruRequest $request)
    {
        $data = $request->all();

        event(new Registered($user = User::create([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'password' => Hash::make($data['dob']),
            'role' => $data['role']
        ])));

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('images/guru', 'public');
        } else {
            $data['foto'] = null;
        }

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

        return redirect()->route('tambah.guru')->with('success', 'Guru Berhasil Dibuat');
    }

    public function updateadmin(Request $request, User $user)
    {
        $this->validate($request,[
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'nama' => 'sometimes|required|string|max:50',
            'oldpass' => ['sometimes', 'required', new CheckOldPassword],
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        $data =  $request->all();

        if ($request->has('password')) {

            $user->update([
                'password' => Hash::make($data['password'])
            ]);

            return redirect(route('admin.profile'))->with('success', 'Password Berhasil Di Update');
        }

        $user->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
        ]);

        return redirect(route('admin.profile'))->with('success', 'Profile Berhasil Di Update');

    }
}
