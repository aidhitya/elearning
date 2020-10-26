<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;

class ListMapelComposer
{
// ->whereIn('kategori', ['Harian', 'Quiz'])
// ->whereIn('kategori', ['Harian', 'Quiz'])
    public function compose(View $view)
    {
        $view->with('list', Kelas::where('id', Auth::user()->murid->kelas_id)->with(['mapels' => function ($q) {
            $q->withCount(['soals as soal_belum' => function ($d) {
                $d->whereDoesntHave('nilais', function ($r) {
                    $r->where('user_id', Auth::id());
                })->has('detail_soal');
            }, 'soals as soal_sudah' => function ($d) {
                $d->whereHas('nilais', function ($r) {
                    $r->where('user_id', Auth::id());
                }, '>=', 2)->has('detail_soal');
            }, 'tugas as tugas_belum' => function ($d) {
                $d->whereDoesntHave('kumpultugas', function ($t) {
                    $t->where('murid_id', Auth::id());
                });
            }, 'tugas as tugas_sudah' => function ($d) {
                $d->whereHas('kumpultugas', function ($r) {
                    $r->where('murid_id', Auth::id());
                });
            }]);
        }])->first());
    }
}
