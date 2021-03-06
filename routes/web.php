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
Route::get('/', function (){
    $home= view('static/home')->render();
//    var_dump($home);die;
    echo file_put_contents('home.html',$home);
});

Route::get('/help', function (){
    $help= view('static/help')->render();
//    var_dump($help);die;
    echo file_put_contents('help.html',$help);
});

Route::get('/about', function (){
    $about= view('static/about')->render();
//    var_dump($about);die;
    echo file_put_contents('about.html',$about);
});

//Route::get('/', 'StaticPagesController@home')->name('home');

//Route::get('/help', 'StaticPagesController@help')->name('help');

//Route::get('/about', 'StaticPagesController@about')->name('about');


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

//管理员密码修改
Route::get('admins/{admin}/pwd_edit','AdminsController@pwd_edit')->name('admins.pwd_edit');
Route::post('admins/{admin}/pwd_edit_save','AdminsController@pwd_edit_save')->name('admins.pwd_edit_save');

//登录
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//图片上传
Route::post('/upload','UploaderController@upload');

//会员资源
Route::resource('users','UsersController');

//权限资源
Route::resource('permissions','PermissionsController');

//角色资源
Route::resource('roles','RolesController');

//禁用会员
Route::get('users/{user}/disable','UsersController@disable')->name('users.disable');

//恢复会员
Route::get('users/{user}/enable','UsersController@enable')->name('users.enable');

//查看订单量统计
Route::get('orders/count','OrdersController@count')->name('orders.count');

//查看菜品销量统计
Route::get('sales/count','SalesController@count')->name('sales.count');

//菜单管理
Route::resource('menus','MenusController');

//发送邮件
//Route::get('/mail',function(){
//    \Illuminate\Support\Facades\Mail::send(
//        'mail',//邮件视图模板
//        ['name'=>'张三'],
//        function ($message){
//            $message->to('252674363@qq.com')->subject('订单确认');
//        }
//    );
//    return '邮件发送成功';
//});

//抽奖活动奖品管理
Route::resource('event_prizes','Event_prizesController');

//抽奖活动管理
Route::resource('events','EventsController');

//抽奖活动列表 页面静态化


//开奖
Route::get('events/{event}/give','EventsController@give')->name('events.give');

//报名列表
Route::get('event_members','Event_membersController@index')->name('event_members.index');

//查看中奖情况
Route::get('events/{event}/result','EventsController@result')->name('events.result');

//测试中文分词搜索


//中文分词搜索
Route::get('sphinxes','SphinxClientController@search')->name('sphinxes.search');