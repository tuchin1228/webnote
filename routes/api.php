<?php

use App\Http\Middleware\apiauthcheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create', [App\Http\Controllers\EditorController::class, 'create'])->middleware(apiauthcheck::class)->name('Create');

Route::post('/uploadimage/{article_id}/{date}', [App\Http\Controllers\EditorController::class, 'uploadimage'])->name('Uploadimage');

Route::post('/update', [App\Http\Controllers\EditorController::class, 'update'])->middleware(apiauthcheck::class)->name('Update');

Route::post('/delete', [App\Http\Controllers\EditorController::class, 'delete'])->middleware(apiauthcheck::class)->name('Delete');

Route::get('/getdata', function () {
    return 'success';
});
