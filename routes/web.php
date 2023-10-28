<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Auth;
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

/*Route::get('/', function () {
    return view('dashboard');
});*/

Route::get('/', [DashboardController::class, 'index']);

Route::get('/detail/{buku}', [DetailController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('komentar', CommentController::class);
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat');