<?php

//登录页面
Route::post('login', 'userController@login');

//注册页面
Route::post('register', 'userController@register');

//验证码
Route::post('phoneCode', 'userController@phoneCode');

//用户详情
Route::post('userInfo', 'userController@userInfo');

//前端调用 修改密码
Route::post('userPwd','userController@userPwd');

//前端调用 修改个人信息
Route::post('userUpdate','userController@userUpdate');

//关注 与取消关注
Route::post('focusUser', 'FansController@focusUser');

//关注列表
Route::post('attention', 'FansController@attention');

//粉丝列表
Route::post('focusList', 'FansController@focusList');

//用户游记接口
Route::post('userYj', 'userController@userYj');

//发布游记
Route::post('addYj', 'PLController@addYj');

//获取游记评论详情列表
Route::post('yjPLList', 'PLController@yjPLList');

//获取单个个游记详情
Route::post('yjDetail', 'PLController@yjDetail');

//用户收藏游记列表接口
Route::post('userCollect', 'CollectController@userCollect');

//用户 收藏 取消收藏 游记接口
Route::post('collect', 'CollectController@collect');

//用户 删除 游记接口
Route::post('yjDel', 'userController@yjDel');

//用户 点赞 游记接口
Route::post('like', 'LikeController@like');

//用户 评论添加 游记接口
Route::post('PL', 'PLController@PL');

//用户 评论删除 游记接口
Route::post('PLDel', 'PLController@PLDel');

//前端调用 上传图片
Route::post('imgUrl','indexController@imgUrl');

