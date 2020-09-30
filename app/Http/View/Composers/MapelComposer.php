<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\User;
use App\Models\Kelas;
use App\Models\Mapel;

class MapelComposer
{

    public function compose(View $view)
    {
        $view->with([
            'kelas' => Kelas::all(),
            'guru' => User::has('guru')->get(),
            'mapel' => Mapel::getParent()->get()
        ]);
    }
}
