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

// HOMEPAGE 
Route::get('/', [App\Http\Controllers\FileController::class, 'index'])->name('home');
Route::get('/file/search', [App\Http\Controllers\FileController::class, 'search'])->name('home');

// ADD FILE
Route::get('/file/add', [App\Http\Controllers\FileController::class, 'viewAddFileSurface']);
Route::post('/file/add', [App\Http\Controllers\FileController::class, 'storeFile']);

// DELETE FILE
Route::delete('/file/delete/{id}', [App\Http\Controllers\FileController::class, 'deleteFile']);

// DOWNLOAD FILE 
Route::get('/file/download/{id}', [App\Http\Controllers\FileController::class, 'downloadFile']);

// CREATE TEXT FILE
Route::get('/file/create/text', [App\Http\Controllers\CreateTextFileController::class, 'viewCreateTextFileSurface']);
Route::post('/file/create/text', [App\Http\Controllers\CreateTextFileController::class, 'createTextFile']);

// SEND FILE
Route::get('/file/send', [App\Http\Controllers\SendFileController::class, 'viewSendFileSurface']);

// EDIT FILE
Route::get('/file/edit/{id}', [App\Http\Controllers\EditFileController::class, 'viewEditFileSurface']);
Route::post('/file/edit/{id}', [App\Http\Controllers\EditFileController::class, 'editFile']);

// USER CHANGERS
Route::get('/user/change/username', [App\Http\Controllers\UserController::class, 'viewUsernameChangerSurface']);
Route::get('/user/change/password', [App\Http\Controllers\UserController::class, 'viewPasswordChangerSurface']);
Route::post('/user/change/username', [App\Http\Controllers\UserController::class, 'usernameChange']);
Route::post('/user/change/password', [App\Http\Controllers\UserController::class, 'passwordChange']);