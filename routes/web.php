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
    //dashboard
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    //message
    Route::resource('/messages', 'Admin\MessageController');
    Route::get('/messages/new', 'Admin\MessageController@new')->name('messages.new');
    Route::get('/messages/old', 'Admin\MessageController@old')->name('messages.old');
    Route::get('/messages/edit/status', 'Admin\MessageController@status')->name('messages.status');
    Route::post('/messages/reply/{id}', 'Admin\MessageController@reply')->name('messages.reply');
    Route::delete('/messages/destroy/{id}/item', 'Admin\MessageController@destroyItem')->name('messages.destroy.item');
    //post
    Route::resource('/post', 'Admin\PostController');
    Route::get('/post/edit/changeStatus', 'Admin\PostController@changeStatus')->name('post.changeStatus');

    //change password
    Route::post('/changePassword', 'Admin\DashboardController@changePassword')->name('password.change');
});
