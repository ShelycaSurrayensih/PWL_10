<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

Route::resource('articles', ArticleController::class);
Route::get('/article/cetak_pdf', [ArticleController::class, 'cetak_pdf']);
Route::resource('mahasiswa', MahasiswaController::class);
Route::get('mahasiswa/nilai/{nim}', [MahasiswaController::class, 'nilai'])->name('mahasiswa.nilai');
Route::post('cari',[MahasiswaController::class,'cari']);
Route::get('mahasiswa/cetak-khs/{nim}', [MahasiswaController::class, 'cetak_pdf'])->name('nilai.cetak');
