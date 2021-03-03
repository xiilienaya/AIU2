<?php
//用户
Route::get("/user","userController@index");
Route::get("/userLogin","userController@userLogin");
Route::post("/userAdmin","userController@update");
Route::post("/delUser","userController@delete");

Route::get("/adminList","userController@adminList");
Route::post("/userSex","userController@userSex");
Route::post("/userString","userController@userString");

//游记
Route::get("/youJi","YouJiController@index");
Route::post("/youJiUpd","YouJiController@update");
Route::post("/youJiDel","YouJiController@delete");

//国家
Route::get("/country","CountryController@index");
Route::post("/countryAdd","CountryController@countryAdd");
Route::post("/countryDel","CountryController@delete");
Route::post("/countryUpd","CountryController@update");

//城市
Route::get("/city","CountryController@city");
Route::post("/cityAdd","CountryController@cityAdd");
Route::post("/cityDel","CountryController@cityDel");
Route::post("/cityUpd","CountryController@cityUpd");

//景点
Route::get("/spot","SpotController@index");
Route::post("/spotAdd","SpotController@add");
Route::post("/spotDel","SpotController@delete");
Route::post("/spotUpd","SpotController@update");
Route::post("/spotDetail","SpotController@spotDetail");
Route::post("/spotT","SpotController@spotT");

Route::get("/hotel","SpotController@hotel");
Route::post("/hotelAdd","SpotController@hotelAdd");
Route::post("/hotelDel","SpotController@hotelDel");
Route::post("/hotelUpd","SpotController@hotelUpd");

Route::post("/planeDetail","SpotController@planeDetail");
Route::post("/planeDel","SpotController@planeDel");
Route::post("/planeUpd","SpotController@planeUpd");
Route::post("/planeAdd","SpotController@planeAdd");

Route::post("/hotelTypeList","HotelTypeController@hotelTypeList");
Route::post("/hotelTypeDel","HotelTypeController@hotelTypeDel");
Route::post("/hotelTypeDetail","HotelTypeController@hotelTypeDetail");
Route::post("/hotelTypeUpd","HotelTypeController@hotelTypeUpd");
Route::post("/hotelTypeAdd","HotelTypeController@hotelTypeAdd");