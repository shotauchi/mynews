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
Route::controller(NewsController::class)->prefix('admin')->group(function() {
    Route::get('profile/create', 'add')->middleware('auth');
});
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その２
// Route::controller(NewsController::class)->group(function() {
//     Route::get('admin/news/create', 'add');
// });
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その３
// Route::get('/admin/news/create', [NewsController::class, 'add']);

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
Route::controller(ProfileController::class)->prefix('admin')->group(function() {
    Route::get('profile/create', 'add')->middleware('auth');
    Route::get('profile/edit', 'edit')->middleware('auth');
    });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
