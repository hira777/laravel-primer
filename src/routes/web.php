<?php

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

// /folders/{id}/tasks にリクエストがきたら、TaskController クラスの index メソッドを呼び出す
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
