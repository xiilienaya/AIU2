<?php
//用户
Route::get("/user","userController@index");
Route::post("/userAdmin","userController@update");
Route::post("/delUser","userController@delete");

//游记
Route::get("/youJi","YouJiController@index");
Route::post("/youJiUpd","YouJiController@update");

//国家
Route::get("/country","CountryController@index");
Route::post("/countryDel","CountryController@delete");
Route::post("/countryUpd","CountryController@update");

//城市
Route::get("/city","CountryController@city");
Route::post("/cityDel","CountryController@cityDel");
Route::post("/cityUpd","CountryController@cityUpd");

//景点
Route::get("/spot","SpotController@index");
Route::post("/spotDel","SpotController@delete");
Route::post("/spotUpd","SpotController@update");
Route::post("/spotT","SpotController@spotT");

Route::get("/hotel","SpotController@index");
Route::post("/hotelDel","SpotController@hotelDel");
Route::post("/hotelUpd","SpotController@hotelUpd");

Route::post("/planeDetail","SpotController@planeDetail");
Route::post("/planeDel","SpotController@planeDel");
Route::post("/planeUpd","SpotController@planeUpd");
