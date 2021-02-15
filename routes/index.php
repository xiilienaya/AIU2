<?php

//登录 注册接口
Route::post('login', 'userController@login');
Route::post('register', 'userController@register');

//验证码
Route::post('phoneCode', 'userController@phoneCode');

//用户详情
Route::post('user', 'userController@user');
Route::post('userPwd','userController@userPwd');        //修改密码
Route::post('userInfo', 'userController@userInfo');     //详情
Route::post('userUpdate','userController@userUpdate');  //修改个人信息

//关注 与取消关注
Route::post('focusUser', 'FansController@focusUser');
Route::post('attention', 'FansController@attention');   //关注列表
Route::post('gzStatus','FansController@gzStatus');  //前端调用 用户关注状态

//粉丝列表
Route::post('focusList', 'FansController@focusList');

//用户游记接口
Route::post('userYj', 'userController@userYj');
Route::post('addYj', 'userController@addYj');         //发布游记
Route::post('yjDel', 'userController@yjDel');       //用户 删除 游记接口
Route::get('yjLBList', 'userController@yjLBList');       //获取轮播数据游记接口
Route::get('yjTjList', 'userController@yjTjList');       //获取首页游记列表 游记接口
Route::post('destination', 'userController@destination');       //根据目的地筛选列表 游记接口

//用户收藏游记列表接口
Route::post('userCollect', 'CollectController@userCollect');

//用户 评论添加 游记接口
Route::post('PL', 'PLController@PL');
Route::post('PLDel', 'PLController@PLDel');     //用户 评论删除 游记接口
Route::post('yjPLList', 'PLController@yjPLList');   //获取游记评论详情列表
Route::post('yjDetail', 'PLController@yjDetail');   //获取单个个游记详情

//前端调用 上传图片
Route::post('imgUrl','indexController@imgUrl');


//前端调用 用户点赞状态  用户 点赞 游记接口
Route::post('like', 'LikeController@like');
Route::post('likeStatus','LikeController@likeStatus');

//前端调用 用户收藏状态 用户 收藏 取消收藏 游记接口
Route::post('collectStatus','CollectController@collectStatus');
Route::post('collect', 'CollectController@collect');

Route::post('spot','SpotController@spot');          //城市获取景点
Route::post('spotDetail','SpotController@spotDetail');  //景点详情
Route::post('spotHot','SpotController@spotHot');        //城市热门景点详情


Route::post('cityDetail','CoutryController@cityDetail');  //城市详情
Route::post('countryDetail','CoutryController@countryDetail');  //国家详情
Route::post('countryHot','CoutryController@countryHot');  //国家热门城市


