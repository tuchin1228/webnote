<?php

// use App\Http\Contorllers\EditorController;
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
    return redirect()->route('Home');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Home');

Route::get('/{tag}/{article_id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('Detail');

Route::get('/editor', [App\Http\Controllers\EditorController::class, 'editor'])->name('Editor');

Route::get('/{tag}/{article_id}/edit', [App\Http\Controllers\EditorController::class, 'edit'])->name('Edit');
