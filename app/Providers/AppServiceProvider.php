<?php

namespace App\Providers;

use App\Http\View\Composers\MapelComposer;
use App\Http\View\Composers\DataKelasComposer;
use App\Http\View\Composers\ListMapelComposer;
use App\Http\View\Composers\MateriComposer;
use App\Http\View\Composers\SoalComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('includes.guru.*', DataKelasComposer::class);
        View::composer('pages.admin.mapel.includes.selects', MapelComposer::class);
        View::composer('pages.umum.materi.admin.includes.form', MateriComposer::class);
        View::composer('pages.umum.soal.includes.form-admin', SoalComposer::class);
        View::composer('pages.siswa.includes.list.*', ListMapelComposer::class);
    }
}
