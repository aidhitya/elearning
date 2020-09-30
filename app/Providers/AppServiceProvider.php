<?php

namespace App\Providers;

use App\Http\View\Composers\MapelComposer;
use App\Http\View\Composers\DataKelasComposer;
use App\Http\View\Composers\MateriComposer;
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
        View::composer('pages.umum.materi.admin.includes.selects', MateriComposer::class);
    }
}
