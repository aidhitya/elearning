<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::doesntHave('kelas')->take(10)->get();

        return view('pages.main.index',[
            'pengumuman' => $pengumuman
        ]);
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::doesntHave('kelas')->get();

        return view('pages.main.pengumuman',[
            'pengumuman' => $pengumuman
        ]);
    }

    public function detail(Pengumuman $pengumuman, $judul)
    {
        if ($judul !== Str::slug($pengumuman->judul)) {
            abort(404);
        }

        return view('pages.main.pengumuman',[
            'pengumuman' => $pengumuman
        ]);
    }
}
