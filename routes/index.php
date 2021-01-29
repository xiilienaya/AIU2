<?php





//Route::any('index', 'IndexController@index');

//登录页面
Route::any('login', 'userController@login');

//注册页面
Route::any('register', 'userController@register');

//验证码
Route::any('phoneCode', 'userController@phoneCode');






