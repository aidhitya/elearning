<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pengumuman;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $murid = User::has('murid')->count();
        $guru = User::has('guru')->count();
        $kelas = Kelas::count();
        $mapel = Mapel::getParent()->count();
        $pengumuman = Pengumuman::with(['author', 'kelas'])->take(5)->get();

        return view('pages.admin.main',[
            'murid' => $murid,
            'guru' => $guru,
            'kelas' => $kelas,
            'mapel' => $mapel,
            'pengumuman' => $pengumuman
        ]);
    }
}
