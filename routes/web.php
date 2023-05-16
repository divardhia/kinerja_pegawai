<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/changeAvatar', [HomeController::class, 'changeAvatar'])->name('user.avatar.change');
Route::post('/changeMode', [App\Http\Controllers\HomeController::class, 'changeMode'])->name('changeMode');

Route::resource('/pegawai', PegawaiController::class);
Route::get('/pegawai/{id}/nilai_kinerja', [PegawaiController::class, 'nilai_kinerja'])->name('pegawai.nilai_kinerja');
Route::post('/pegawai/nilai_kinerja', [PegawaiController::class, 'store_nilai_kinerja'])->name('pegawai.nilai_kinerja.store');

// edit bobot
Route::get('/bobot', [BobotController::class, 'edit'])->name('bobot.edit');
Route::post('/bobot/update', [BobotController::class, 'update'])->name('bobot.update');

// kegiatan
Route::resource('/kegiatan', KegiatanController::class);

// penilaian
Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');

Route::get('/', function () {
    return redirect()->route('login');
});
