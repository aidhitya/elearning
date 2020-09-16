<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('guru', 'GuruController')->middleware(['auth', 'verified', 'roles:1']);

Route::resource('murid', 'MuridController')->middleware(['auth', 'verified', 'roles:2']);

Route::prefix('admin')->middleware(['auth', 'verified', 'roles:0'])->group(function () {
    Route::view('/', 'pages.admin.main')->name('home.admin');
    Route::resource('kelas', 'KelasController');
    Route::get('mapel', 'MapelController@index');
    Route::get('mapel/create', 'MapelController@create')->name('mapel.create');
    Route::post('mapel', 'MapelController@store')->name('mapel.store');
});

Route::middleware(['auth', 'verified', 'roles:0,1'])->group(function () {
    Route::resource('materi', 'MateriController');
    Route::resource('soal', 'SoalController');
    Route::resource('soal/detail', 'DetailSoalController')->except('create', 'store');

    Route::post('soal/{soal}/detail/store', 'DetailSoalController@store')->name('detail.store');
    Route::get('soal/detail/{soal}/create', 'DetailSoalController@create')->name('detail.create');

    Route::post('soal/create', 'SoalController@create')->name('post.materi.soal');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
