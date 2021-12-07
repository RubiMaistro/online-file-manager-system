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

Route::get('/file/create/text', [App\Http\Controllers\CreateTextFileController::class, 'viewCreateTextFileSurface'])->middleware('auth');
Route::post('/file/create/text', [App\Http\Controllers\CreateTextFileController::class, 'createTextFile'])->middleware('auth');

Route::get('/file/send', [App\Http\Controllers\SendFileController::class, 'viewSendFileSurface'])->middleware('auth');
Route::post('/file/send/{name}', [App\Http\Controllers\SendFileController::class, 'sendFile'])->middleware('auth');

Route::get('/file/edit/{id}', [App\Http\Controllers\EditFileController::class, 'viewEditFileSurface'])->middleware('auth');
Route::post('/file/edit/{id}', [App\Http\Controllers\EditFileController::class, 'editFile'])->middleware('auth');

