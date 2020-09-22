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

Route::resource('murid', 'MuridController')->middleware(['auth', 'verified', 'roles:2']);

Route::namespace('Guru')->prefix('guru')->middleware(['auth', 'verified', 'roles:1'])->group(function () {
    Route::get('/', 'GuruController@index');
    Route::resource('guru', 'GuruController')->except('index');
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'verified', 'roles:0'])->group(function () {
    Route::view('/', 'pages.admin.main')->name('home.admin');
    Route::resource('kelas', 'KelasController');
    Route::resource('mapel', 'MapelController')->except('show');
});

Route::namespace('Umum')->middleware(['auth', 'verified', 'roles:0,1'])->group(function () {
    Route::resource('materi', 'MateriController');
    Route::resource('soal', 'SoalController');
    Route::resource('soal/detail', 'DetailSoalController')->except('create', 'store');

    Route::post('soal/{soal}/excel/store', 'DetailSoalController@excel')->name('detail.excel');
    Route::post('soal/{soal}/detail/store', 'DetailSoalController@store')->name('detail.store');
    Route::get('soal/detail/{soal}/create', 'DetailSoalController@create')->name('detail.create');

    Route::post('soal/create', 'SoalController@create')->name('post.materi.soal');
    Route::post('soal/{soal}/edit', 'SoalController@create')->name('post.edit.soal');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
