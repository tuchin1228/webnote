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

//首頁
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('Home');

//搜尋文章
Route::get('/search/{keyword}', [App\Http\Controllers\HomeController::class, 'search'])->name('Search');

//分類文章列表
Route::get('/{tag}', [App\Http\Controllers\HomeController::class, 'TagView'])->name('TagView');

//內文
Route::get('/{tag}/{article_id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('Detail');

//發文
Route::get('/editor', [App\Http\Controllers\EditorController::class, 'editor'])->name('Editor');

//編輯
Route::get('/{tag}/{article_id}/edit', [App\Http\Controllers\EditorController::class, 'edit'])->name('Edit');

//無用圖片管理
Route::get('/imagenone', [App\Http\Controllers\HomeController::class, 'imagenone'])->name('ImageNone');

//無用圖片管理
Route::post('/deletenotuse', [App\Http\Controllers\HomeController::class, 'deletenotuse'])->name('DeleteNotuse');
