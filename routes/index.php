<?php





//Route::any('index', 'IndexController@index');

//登录页面
Route::any('login', 'userController@login');

//注册页面
Route::any('register', 'userController@register');

//验证码
Route::any('phoneCode', 'userController@phoneCode');

//用户详情
Route::any('userInfo', 'userController@userInfo');

//关注 与取消关注
Route::any('focusUser', 'FansController@focusUser');

//关注列表
Route::any('attention', 'FansController@attention');

//粉丝列表
Route::any('focusList', 'FansController@focusList');


