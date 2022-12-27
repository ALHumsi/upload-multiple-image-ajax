<?php

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


Route::get('/', function () {
    return view('welcome');
});


Route::post('/upload-images', [\App\Http\Controllers\UploadController::class, 'uploadImages']);

Route::get('/upload', [\App\Http\Controllers\UploadController::class, 'upload']);

Route::get('/show-form', [\App\Http\Controllers\UploadController::class, 'showForm']);

Route::post('/store-images', [\App\Http\Controllers\UploadController::class, 'storeImages']);
