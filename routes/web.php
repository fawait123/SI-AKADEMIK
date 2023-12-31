<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',function (){
    return redirect()->route('login');
});

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('login',[\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('logout',[\App\Http\Controllers\AuthController::class,'logout'])->name('logout');

Route::get('home',[\App\Http\Controllers\HomeController::class,'index'])->middleware('auth')->name('home');


Route::group(['middleware'=>'auth'],function (){
    //    ROUTE GURU
    Route::get('guru-mapel',[\App\Http\Controllers\MapelController::class,'gurumapel'])->name('guru.mapel');
    Route::get('guru-kehadiran',[\App\Http\Controllers\MapelController::class,'kehadiran'])->name('guru.kehadiran');
    Route::post('guru-kehadiran',[\App\Http\Controllers\MapelController::class,'kehadiranAction'])->name('guru.kehadiran');
    Route::get('list-kehadiran',[\App\Http\Controllers\MapelController::class,'listKehadiran'])->name('kehadiran.list');

//    ROUTE NILAI GURU
    Route::get('guru-nilai',[\App\Http\Controllers\NilaiController::class,'inputNilai'])->name('guru.nilai');
    Route::post('guru-nilai',[\App\Http\Controllers\NilaiController::class,'storeNilai'])->name('guru.nilai');
    Route::get('list-nilai',[\App\Http\Controllers\NilaiController::class,'listNilai'])->name('list.nilai');


    Route::resource('guru',\App\Http\Controllers\GuruController::class);
    Route::resource('user',\App\Http\Controllers\UserController::class);
    Route::resource('tahun-akademik',\App\Http\Controllers\TahunAkademikController::class);
    Route::resource('wali-kelas',\App\Http\Controllers\WaliKelasController::class)->parameters(['wali-kelas'=>'wali_kelas']);
    Route::resource('mapel',\App\Http\Controllers\MapelController::class);
    Route::resource('siswa',\App\Http\Controllers\SiswaController::class);
    Route::resource('sesi',\App\Http\Controllers\SesiController::class);
    Route::resource('kelas-siswa',\App\Http\Controllers\KelasSiswaController::class)->parameters(['kelas-siswa'=>'kelas_siswa']);


    Route::get('legger',[\App\Http\Controllers\LeggerController::class,'index'])->name('legger.index');
    Route::get('legger/download',[\App\Http\Controllers\LeggerController::class,'download'])->name('legger.download');


//    raport
    Route::get('raport',[\App\Http\Controllers\RaportController::class,'index'])->name('raport.index');
    Route::get('raport/download',[\App\Http\Controllers\RaportController::class,'download'])->name('raport.download');
});
