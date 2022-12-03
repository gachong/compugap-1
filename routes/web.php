<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'perform'])->name('logout');

Route::get('/file-import',[ProductController::class,'importView'])->name('file-import');

Route::post('/import',[ProductController::class,'import'])->name('import');

Route::get('/export-product',[ProductController::class,'exportProducts'])->name('export-product');

Route::post('/uploadcsv', [App\Http\Controllers\ReadCsvController::class, 'storeFile'])->name('uploadcsv');

Route::get('/send-info',[ProductController::class,'SendApi'])->name('send-info');