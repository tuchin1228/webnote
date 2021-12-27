<?php

// use App\Http\Contorllers\EditorController;
use App\Http\Middleware\authcheck;
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

//管理員登入
Route::get('/login', [App\Http\Controllers\HomeController::class, 'login'])->name('Login');

//管理員登入
Route::post('/login', [App\Http\Controllers\HomeController::class, 'login_check'])->name('LoginCheck');

//管理員登出
Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('Logout');

//發文
Route::get('/editor', [App\Http\Controllers\EditorController::class, 'editor'])->middleware(authcheck::class)->name('Editor');

//無用圖片管理
Route::get('/imagenone', [App\Http\Controllers\HomeController::class, 'imagenone'])->middleware(authcheck::class)->name('ImageNone');

//無用圖片管理
Route::post('/deletenotuse', [App\Http\Controllers\HomeController::class, 'deletenotuse'])->name('DeleteNotuse');

//分類文章列表
Route::get('/{tag}', [App\Http\Controllers\HomeController::class, 'TagView'])->name('TagView');

//內文
Route::get('/{tag}/{article_id}', [App\Http\Controllers\HomeController::class, 'detail'])->name('Detail');

//編輯
Route::get('/{tag}/{article_id}/edit', [App\Http\Controllers\EditorController::class, 'edit'])->middleware(authcheck::class)->name('Edit');
