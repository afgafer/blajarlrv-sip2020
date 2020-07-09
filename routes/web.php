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

Route::get('/','FrontController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth','type']], function () {
    Route::resource('dest','DestController');
    Route::resource('hotel','HotelController');
    Route::resource('room','RoomController');
    Route::resource('article','ArticleController');

    Route::get('image/create',['uses'=>'ImageController@create','as'=>'image.create']);
    Route::put('confirm/{id}/image','ImageController@pConfirm')->name('image.pConfirm');

    Route::resource('event','EventController');
    Route::resource('admin','AdminController');
    Route::put('admin/upload/{id}','AdminController@upload')->name('admin.upload');

    Route::get('order/search',['uses'=>'OrderController@search','as'=>'order.search']);
    Route::get('order/filter','OrderController@filter')->name('order.filter');
    Route::get('order/transaction','OrderController@index')->name('order.transaction');
    Route::get('order/payment','OrderController@index')->name('order.payment');
    Route::get('order/report','OrderController@report')->name('order.report');
    Route::get('order/export','OrderController@ordersEx')->name('order.export');

    
    Route::get('order/income','OrderController@income')->name('order.income');
    Route::get('order/count',['uses'=>'OrderController@count','as'=>'order.count']);
    Route::resource('order','OrderController')->except('store');

    Route::put('order/{id}/confirm','OrderController@confirm')->name('order.confirm');
});
//Route::resource('user','UserController');
Route::group(['prefix' => '/', 'middleware' => ['auth']], function () {
    Route::resource('image','ImageController')->except('create');
});

Route::group(['prefix' => '/member', 'middleware' => ['auth']], function () {
    Route::get('member/{id}','MemberController@show')->name('member.show');
    Route::put('member/upload/{id}','MemberController@upload')->name('member.upload');

    Route::get('order/form','OrderController@form')->name('order.form');
    Route::get('order/select','OrderController@select')->name('order.select');
    Route::get('order/choice/{id}','OrderController@choice')->name('order.choice');

    Route::get('order/room/choice/{id}','OrderController@room')->name('order.room');
    Route::get('order/room/{id}',['uses'=>'OrderController@roomS','as'=>'order.roomshow']);

    Route::get('cart/',['uses'=>'CartController@index','as'=>'cart.index']);
    Route::post('c/{id}/take',['uses'=>'CartController@take','as'=>'cart.take']);
    Route::post('cart/create',['uses'=>'CartController@create','as'=>'cart.create']);
    Route::post('cart/search',['uses'=>'CartController@search','as'=>'cart.search']);//

    //Route::post('cart/{id}',['uses'=>'CartController@show','as'=>'cart.show']);
    Route::post('cart/{id}/remove',['uses'=>'CartController@remove','as'=>'cart.remove']);
    Route::post('cart/{id}/destroy',['uses'=>'CartController@destroy','as'=>'cart.destroy']);
    Route::delete('cart/drop',['uses'=>'CartController@drop','as'=>'cart.drop']);

    Route::get('image/create',['uses'=>'ImageController@createA','as'=>'image.createA']);

    Route::post('order/store',['uses'=>'OrderController@store','as'=>'order.store']);
    Route::get('order','OrderController@indexA')->name('order.indexA');
    Route::get('order/{id}','OrderController@showA')->name('order.showA');
    Route::put('order/{id}/upload','OrderController@upload')->name('order.upload');
    Route::put('cancel/{id}/','OrderController@cancel')->name('order.cancel');
});

//Route::get('user/{id}','UserController@show')->name('user.show');

Route::get('dest/map','DestController@map')->name('dest.map');
Route::get('dest','DestController@indexA')->name('dest.indexA');
Route::get('dest/{id}','DestController@show')->name('dest.showA');

Route::get('hotel/map','HotelController@map')->name('hotel.map');
Route::get('hotel','HotelController@indexA')->name('hotel.indexA');
Route::get('hotel/{id}','HotelController@show')->name('hotel.showA');
Route::get('room/search','RoomController@search')->name('room.search');
Route::get('room/check','RoomController@check')->name('room.check');
Route::get('room/show/{id}','RoomController@roomS')->name('room.roomshow');
Route::get('room','RoomController@indexA')->name('room.indexA');
Route::get('room/{id}','RoomController@show')->name('room.showA');
Route::get('article','ArticleController@indexA')->name('article.indexA');
Route::get('article/{id}','ArticleController@show')->name('article.showA');
Route::get('event','EventController@indexA')->name('event.indexA');
Route::get('event/{id}','EventController@show')->name('event.showA');

Route::get('images','ImageController@indexA')->name('image.indexA');
