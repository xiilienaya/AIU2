<?php


// Route::get('/', function () {
//     return view('welcome'); 
// });

//登录页面
Route::any('admin', 'adminController@admin');
//登录页面
Route::any('login', 'adminController@login');

//图片上传jpg
Route::any('uploadImg', 'adminController@uploadImg');
