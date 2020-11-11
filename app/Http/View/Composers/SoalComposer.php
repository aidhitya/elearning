<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Support\Facades\Auth;

class SoalComposer
{

    public function compose(View $view)
    {
        if (Auth::user()->is_admin) {
            $view->with([
                'kelas' => Kelas::select('kelas')->distinct()->orderBy('kelas')->get(),
                'mapel' => Mapel::getParent()->get()
            ]);
        }
    }
}
