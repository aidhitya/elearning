<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class ListMapelComposer
{

    public function compose(View $view)
    {
        $view->with('list', $list = Kelas::where('id', Auth::user()->murid->kelas_id)->with(['mapels' => function ($q) {
            $q->withCount(['soals as soal_belum' => function ($d) {
                $d->whereIn('kategori', ['Harian', 'Quiz'])->has('detail_soal')->whereDoesntHave('nilais', function($r) {
                    $r->where('user_id', Auth::id());
                });
            }, 'soals as soal_sudah' => function ($d) {
                $d->whereIn('kategori', ['Harian', 'Quiz'])->has('detail_soal')->whereHas('nilais', function($r) {
                    $r->where('user_id', Auth::id());
                });
            }, 'tugas as tugas_belum' => function ($d) {
                $d->whereDoesntHave('kumpultugas', function($t) {
                    $t->where('murid_id', Auth::id());
                });
            }, 'tugas as tugas_sudah' => function($d) {
                $d->whereHas('kumpultugas', function($r) {
                    $r->where('murid_id', Auth::id());
                });
            }]);
        }])->first());
    }
}
