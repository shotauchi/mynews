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

use App\Http\Controllers\Admin\NewsController;
// ルーティング設定、その１
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その２
 //Route::controller(NewsController::class)->group(function() {
     //Route::get('admin/news/create', 'add');
// });
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その３
 //Route::get('/admin/news/create', [NewsController::class, 'add']);

// // 課題３－３）
// // 「http://XXXXXX.jp/XXX というアクセスが来たときに、
// // AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください
// use App\Http\Controllers\AAAController;
// //                       ^^^^^^^^^^^^^
// //  ^^^^^^^^^^^^^^^^^^^^^ コントローラが保存されているフォルダとして固定となる
// // use 宣言を使って、使用する AAAController コントローラを指定する
// Route::get('/XXX', [AAAController::class, 'bbb']);
// //                                         ^^^^ bbb というアクション
// //                  ^^^^^^^^^^^^^^^^^^^^ AAAController コントローラ
// //         ^^^^^^ /XXX というアクセスが来たとき

// 課題３－４）
// 【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。
// web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、
// admin/profile/edit にアクセスしたら ProfileController の edit Action に割り当てるように設定してください

use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('profile/create', 'add')->name('profile.add');
    Route::post('profile/create', 'create')->name('profile.create');
    Route::get('profile', 'index')->name('profile.index');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\NewsController as PublicNewsController;
Route::get('/', [PublicNewsController::class, 'index'])->name('news.index');

// 【応用】 routes/web.phpを編集して、 /profile にアクセスが来たら
// ProfileController/index Action に渡すように設定してください
use App\Http\Controllers\ProfileController as PublicProfileController;
Route::get('/profile', [PublicProfileController::class, 'index'])->name('profile.index');