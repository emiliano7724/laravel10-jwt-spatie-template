<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('/register',[\App\Http\Controllers\RegisterController::class,'register']);
    Route::apiResource('permisos', \App\Http\Controllers\SpatiePermissionController::class);

});

Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::get('/pdf-test',[\App\Http\Controllers\PdfControllerController::class,'index']);




