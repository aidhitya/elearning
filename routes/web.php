<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\User;

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

Route::namespace('Murid')->middleware(['auth', 'verified', 'roles:2'])->group(function(){
    Route::resource('murid', 'MuridController');
    Route::get('murid/mapel/{mapel}', 'DataMuridController@mapel')->name('murid.mapel');
    Route::get('murid/mapel/{mapel}/{materi}', 'DataMuridController@materi')->name('murid.materi');

    Route::get('soal/{kategori}/{mapel}/{soal}', 'MengerjakanController@soal')->name('murid.soal');
    Route::post('soal/{kategori}/{mapel}/{soal}', 'MengerjakanController@slide')->name('murid.slide');

    Route::post('soal/{kategori}/{mapel}/{soal}/checking', 'CheckerController')->name('soal.checking');
    Route::get('soal/{kategori}/{mapel}/{soal}/checking', 'CheckerController')->name('soal.check');

    Route::post('soal/{soal}/selesai', 'NilaiController@selesai')->name('soal.selesai');
});

Route::namespace('Guru')->prefix('guru')->middleware(['auth', 'verified', 'roles:1'])->group(function () {
    Route::view('/', 'pages.guru.main')->name('home.guru'); 
    Route::resource('guru', 'GuruController');
    Route::get('kelas/{kelas}', 'DataKelasController@index')->name('data.kelas.guru');
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'verified', 'roles:0'])->group(function () {
    Route::view('/', 'pages.admin.main')->name('home.admin');
    Route::resource('kelas', 'KelasController');
    Route::resource('mapel', 'MapelController')->except('show');
});

Route::prefix('assets')->namespace('Umum')->middleware(['auth', 'verified', 'roles:0,1'])->group(function () {
    Route::resource('materi', 'MateriController')->except('show', 'create');
    Route::resource('soal', 'SoalController');
    Route::resource('soal/detail', 'DetailSoalController')->except('create', 'store');

    Route::get('materi/create/{kelas?}', 'MateriController@create')->name('materi.create');
    Route::get('materi/{kelas}/{materi?}', 'MateriController@show')->name('materi.show');
    Route::post('soal/{soal}/excel/store', 'DetailSoalController@excel')->name('detail.excel');
    Route::post('soal/{soal}/detail/store', 'DetailSoalController@store')->name('detail.store');
    Route::get('soal/detail/{soal}/create', 'DetailSoalController@create')->name('detail.create');

    Route::post('soal/create', 'SoalController@create')->name('post.materi.soal');
    Route::post('soal/{soal}/edit', 'SoalController@create')->name('post.edit.soal');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
