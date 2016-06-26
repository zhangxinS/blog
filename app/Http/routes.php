<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/blog');
});
Route::get('blog','BlogController@index');
Route::get('blog/{slug}','BlogController@showPost');

//Admin
Route::get('admin',function () {
   return redirect('/admin/post');
});
Route::group(['namespace' => 'Admin','middleware' => 'auth'],function () {
   Route::resource('admin/post','PostController');
   Route::resource('admin/tag','TagController');
   Route::get('admin/upload','UploadController@index');
});

//登录  登出
Route::get('/auth/login','Auth\AuthController@getLogin');
Route::post('/auth/login','Auth\AuthController@postLogin');
Route::get('/auth/logout','Auth\AuthController@getLogout');