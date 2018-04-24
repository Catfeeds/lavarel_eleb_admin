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

//Route::get('/', function () {
//    return view('welcome');
//});
//  以/ get请求 映射到StaticPagesController控制器的home方法
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

//商铺分类资源
Route::resource('cats','CatsController');

//店铺资源
//Route::resource('members','MemberController');
Route::resource('members','TestController');

//活动资源
Route::resource('activities','ActivitiesController');

//修改审核状态
Route::get('members/{member}/change','TestController@change')->name('members.change');

//管理员资源
Route::resource('admins','AdminsController');

//登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//图片上传
Route::post('/upload','UploaderController@upload');