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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/all/pengumuman', 'HomeController@pengumuman')->name('home.pengumuman');
Route::get('/p/{pengumuman}/{judul}', 'HomeController@detail')->name('detail.pengumuman');

Route::namespace('Murid')->middleware(['auth', 'verified', 'roles:2'])->group(function(){
    Route::resource('murid', 'MuridController')->except('store', 'destroy', 'create');
    Route::get('mapel', 'DataMuridController@listmapel')->name('list.mapel');
    Route::get('mapel/{mapel}', 'DataMuridController@mapel')->name('murid.mapel');
    Route::get('mapel/{mapel}/{materi}', 'DataMuridController@materi')->name('murid.materi');

    Route::get('soal', 'DataMuridController@listsoal')->name('list.soal');
    Route::get('soal/{mapel}/{slug}', 'DataMuridController@detailsoal')->name('detail.soal');

    Route::get('soal/{kategori}/{mapel}/{soal}', 'MengerjakanController@soal')->name('murid.soal');
    Route::post('soal/{kategori}/{mapel}/{soal}', 'MengerjakanController@slide')->name('murid.slide');

    Route::post('soal/{kategori}/{mapel}/{soal}/checking', 'CheckerController')->name('soal.checking');
    Route::get('soal/{kategori}/{mapel}/{soal}/checking', 'CheckerController')->name('soal.check');

    Route::post('soal/{soal}/selesai', 'NilaiController@selesai')->name('soal.selesai');
    Route::get('soal/{kategori}/{mapel}/{soal}/nilai/{try}', 'NilaiController@nilaipdf')->name('get.nilai.pdf');

    Route::get('tugas', 'DataMuridController@listtugas')->name('list.tugas');
    Route::get('tugas/{mapel}/{slug}', 'DataMuridController@detailtugas')->name('detail.tugas');
    Route::get('tugas/detail/{tugas}/{judul}', 'MengerjakanController@tugas')->name('murid.tugas');
    Route::post('tugas/detail/{tugas}/{judul}', 'MengerjakanController@kumpultugas')->name('murid.kumpul.tugas');
    
    Route::get('detail/pengumuman/{pengumuman}/{judul}', 'DataMuridController@pengumuman')->name('pengumuman.murid');
});

Route::namespace('Guru')->prefix('guru')->middleware(['auth', 'verified', 'roles:1'])->group(function () {
    Route::get('/', 'GuruController@index')->name('home.guru'); 
    Route::resource('guru', 'GuruController')->except('index', 'store', 'destroy', 'create');
    Route::get('kelas/{kelas}', 'DataKelasController@index')->name('data.kelas.guru');
    Route::get('soal', 'DataKelasController@soal')->name('data.soal.guru');
    Route::get('soal/{kelas}/{soal}/detail/{judul}', 'DataKelasController@detailmurid')->name('detail.soal.murid');
    Route::get('soal/{kelas}/{m}/{mapel}', 'DataKelasController@detailsoal')->name('detail.soal.guru');
    Route::resource('tugas', 'TugasController');
    Route::post('tugas/nilai/{tugas}', 'TugasController@nilai')->name('nilai.tugas');
    Route::get('nilai/export/soal/{soal}/{kelas}', 'DataKelasController@exportNilai')->name('soal.nilai.export');
    Route::get('nilai/export/tugas/{tugas}/{kelas}', 'DataKelasController@exportNilai')->name('tugas.nilai.export');
    Route::get('nilai/export/mapel/{mapel}/{kelas}', 'DataKelasController@exportNilai')->name('mapel.nilai.export');
});

Route::namespace('Admin')->prefix('admin')->middleware(['auth', 'verified', 'roles:0'])->group(function () {
    Route::get('/', 'AdminController')->name('home.admin');
    Route::resource('kelas', 'KelasController')->except('show');
    Route::resource('mapel', 'MapelController')->except('show');
    Route::get('nilai', 'DataAdminController@kelas')->name('nilai.admin');
    Route::get('nilai/{kelas}/{kel}', 'DataAdminController@detailkelas')->name('nilai.mapel');
    Route::get('nilai/{kelas}/{kel}/{map}/{mapel}', 'DataAdminController@detailmapel')->name('nilai.soal');
    Route::get('nilai/{kelas}/{kel}/{map}/{mapel}/{so}/{soal}', 'DataAdminController@detailsoal')->name('nilai.murid');
    Route::get('list/siswa', 'UsersController@allsiswa')->name('all.siswa');
    Route::get('list/guru', 'UsersController@allguru')->name('all.guru');
    Route::get('tambah/siswa', 'UsersController@tambahsiswa')->name('tambah.siswa');
    Route::get('tambah/guru', 'UsersController@tambahguru')->name('tambah.guru');
    Route::post('store/siswa', 'UsersController@storesiswa')->name('store.siswa');
    Route::post('store/guru', 'UsersController@storeguru')->name('store.guru');
    Route::post('edit/siswa', 'UsersController@editsiswa')->name('edit.siswa');
    Route::post('edit/guru', 'UsersController@editguru')->name('edit.guru');
    Route::post('user/activation/{user}', 'UsersController@status')->name('activation');
    Route::delete('user/delete/{user}', 'UsersController@userdelete')->name('delete.user');
    Route::get('profile', 'DataAdminController@profile')->name('admin.profile');
    Route::put('update/profile/{user}', 'UsersController@updateadmin')->name('admin.profile.update');
    Route::post('tambah/excel/murid', 'ExceluserController@murid')->name('excel.murid');
    Route::post('tambah/excel/guru', 'ExceluserController@guru')->name('excel.guru');
    Route::get('assets/tugas', 'DataAdminController@alltugas')->name('tugas.admin');
    Route::get('assets/tugas/{tugas}', 'DataAdminController@tugasshow')->name('tugas.admin.show');
    Route::delete('assets/tugas/{tugas}', 'DataAdminController@tugasdelete')->name('tugas.admin.delete');
});

Route::namespace('Umum')->middleware(['auth', 'verified', 'roles:0,1'])->group(function () {
    Route::prefix('assets')->group(function(){
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

    Route::resource('pengumuman', 'PengumumanController');
});


Auth::routes(['verify' => true, 'register' => false]);
