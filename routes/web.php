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
    return view('admin.admin.index');
});

#################################################   通过路由前缀区分前后台   #######################################################


#################################################   通过域名区分前后台   #######################################################

Route::group(['namespace'=>'Index'],function () {
    include base_path() . '/routes/index.php';
});

Route::group(['namespace'=>'Admin','prefix'=>'admin'],function () {
    include base_path() . '/routes/admin.php';
});


#################################################   通过域名区分前后台   #######################################################
