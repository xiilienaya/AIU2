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

//用户游记接口
Route::any('userYj', 'userController@userYj');

//用户收藏游记列表接口
Route::any('userCollect', 'CollectController@userCollect');

//用户 收藏 取消收藏 游记接口
Route::any('collect', 'CollectController@collect');

//用户删除游记接口
Route::any('yjDel', 'userController@yjDel');


