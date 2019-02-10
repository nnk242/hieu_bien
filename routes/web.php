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

Route::get('/', 'HomeController@index')->name('frontend.index');
Route::post('/', 'HomeController@sendMessage')->name('frontend.sendMessage');


Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
//    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::resource('/post', 'Admin\PostController');
    Route::get('/post/edit/changeStatus}', 'Admin\PostController@changeStatus')->name('post.changeStatus');
});
