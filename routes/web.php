<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [App\Http\Controllers\FileController::class, 'index'])->name('home');
Route::get('/file/add', [App\Http\Controllers\FileController::class, 'viewAddFileSurface'])->middleware('auth');
Route::post('/file/add', [App\Http\Controllers\FileController::class, 'storeFile'])->middleware('auth');
Route::delete('/file/delete/{id}', [App\Http\Controllers\FileController::class, 'deleteFile'])->middleware('auth');


