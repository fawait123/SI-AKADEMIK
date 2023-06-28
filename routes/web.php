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
    Route::resource('guru',\App\Http\Controllers\GuruController::class);
    Route::resource('user',\App\Http\Controllers\UserController::class);
    Route::resource('tahun-akademik',\App\Http\Controllers\TahunAkademikController::class);
    Route::resource('wali-kelas',\App\Http\Controllers\WaliKelasController::class)->parameters(['wali-kelas'=>'wali_kelas']);
    Route::resource('mapel',\App\Http\Controllers\MapelController::class);
    Route::resource('siswa',\App\Http\Controllers\SiswaController::class);
    Route::resource('sesi',\App\Http\Controllers\SesiController::class);
    Route::resource('kelas-siswa',\App\Http\Controllers\KelasSiswaController::class)->parameters(['kelas-siswa'=>'kelas_siswa']);
});
