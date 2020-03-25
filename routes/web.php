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

//Route::get('//', function () {
//    return view('welcome');
//});
Route::get('index/index','Index\IndexController@index');
Route::get('/','Index\IndexController@login');
Route::get('index/reg','Index\IndexController@reg');
Route::post('/index/index/save','Index\IndexController@save');
Route::post('/index/sel','Index\IndexController@sel');
Route::post('index/index/money','Index\IndexController@money');
Route::post('index/index/fen','Index\IndexController@fen');
Route::post('index/index/fens','Index\IndexController@fens');



