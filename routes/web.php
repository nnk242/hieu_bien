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
Route::get('/{post}', 'HomeController@post_')->name('frontend.post')->middleware('filter');
Route::get('/danh-muc/{category}', 'HomeController@category_')->name('frontend.category');
Route::get('/tim-kiem/{search}', 'HomeController@search')->name('frontend.search');
Route::get('/api/tim-kiem', 'HomeController@apiSearch')->name('frontend.api.search');
Route::post('/', 'HomeController@sendMessage')->name('frontend.sendMessage');

Route::get('/tag/{tag}', 'HomeController@tag')->name('frontend.tag');


Route::group(['prefix' => 'admin'], function () {
    Auth::routes();
    //dashboard
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
    Route::post('/dashboard/tag/edit', 'Admin\DashboardController@tag')->name('dashboard.tag.edit');
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
    Route::get('/post/edit/changeSlide', 'Admin\PostController@changeSlide')->name('post.changeSlide');
    Route::get('/post/active/slide', 'Admin\PostController@activeSlide')->name('post.activeSlide');

    //category
    Route::resource('/category', 'Admin\CategoryController');
    Route::get('/category/edit/changeStatus', 'Admin\CategoryController@changeStatus')->name('category.changeStatus');

    //category
    Route::resource('/price', 'Admin\PriceController');
    Route::post('/price/type/add', 'Admin\PriceController@addType')->name('type.create');
    Route::delete('/price/type/delete/{type}', 'Admin\PriceController@destroyType')->name('type.destroy');
    Route::get('/price/type/{type}/edit', 'Admin\PriceController@editType')->name('type.edit');
    Route::put('/price/type/{type}', 'Admin\PriceController@updateType')->name('type.update');
    Route::get('/price/edit/changeStatus', 'Admin\PriceController@changeStatus')->name('price.changeStatus');

    //change password
    Route::post('/changePassword', 'Admin\DashboardController@changePassword')->name('password.change');
});
