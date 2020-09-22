<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\User;
use Illuminate\Support\Facades\Auth;

class DataKelasComposer
{

    public function compose(View $view)
    {
        $view->with('datakelas', User::where('id', Auth::id())->with(['mengajar.kelas' => function ($q) {
            $q->orderBy('kelas')->get();
        }])->first());
    }
}
