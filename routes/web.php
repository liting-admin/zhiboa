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
Route::get('login','Index\IndexController@login');
Route::get('index/reg','Index\IndexController@reg');
Route::post('/index/save','Index\IndexController@save');
Route::post('/index/sel','Index\IndexController@sel');
Route::post('index/index/money','Index\IndexController@money');
Route::post('index/index/fen','Index\IndexController@fen');
Route::post('index/index/fens','Index\IndexController@fens');
Route::get('index/qr','Index\IndexController@qr');
Route::get('index/ing','Index\IndexController@ing');
Route::get('image','Index\IndexController@image');
Route::get('log','Index\IndexController@logs');
Route::get('/','Index\IndexController@shou');
Route::get('tel','Index\IndexController@tel');
Route::get('/index/login','Index\IndexController@login');
Route::get('/index/tel','Index\IndexController@tel');
Route::get('/index/index/ing','Index\IndexController@ing');
Route::get('zhu','Index\IndexController@zhu');
Route::post('index/ma','Index\IndexController@ma');
Route::post('index/insert','Index\IndexController@insert');
Route::get('index/zhu','Index\IndexController@zhu');
Route::post('index/index/save','Index\IndexController@save');
Route::get('index/index/tel','Index\IndexController@tel');








