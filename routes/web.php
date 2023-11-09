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
    Route::get('news/create', 'add');
});
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その２
// Route::controller(NewsController::class)->group(function() {
//     Route::get('admin/news/create', 'add');
// });
// ↑↑↑書き換えられるように↓↓↓
// // ルーティング設定、その３
// Route::get('/admin/news/create', [(NewsController::class, 'add']);
