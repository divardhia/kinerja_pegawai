<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
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

// edit bobot
Route::get('/bobot', [BobotController::class, 'edit'])->name('bobot.edit');
Route::post('/bobot/update', [BobotController::class, 'update'])->name('bobot.update');

Route::get('/', function () {
    return redirect()->route('login');
});
