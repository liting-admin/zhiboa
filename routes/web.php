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
Route::get('index/form','Index\IndexController@rn');
Route::get('index/re','Index\IndexController@wer');
Route::post('index/ion','Index\IndexController@ion');
Route::get('index/aa/{res}','Index\IndexController@aa');
Route::get('index/pai','Index\IndexController@pai');
Route::get('index/xi','Index\IndexController@xi');
Route::get('/index/index/ai','Index\IndexController@ai');
Route::post('index/ci','Index\IndexController@ci');
Route::post('index/ais','Index\IndexController@ais');
Route::get('index/lg','Index\IndexController@lg');
Route::get('index/index/lg','Index\IndexController@lg');
Route::post('index/sa','Index\IndexController@sa');
Route::get('index/index/index/lg','Index\IndexController@lg');
Route::post('index/index/index/index/sa','Index\IndexController@sa');
Route::post('index/index/index/sa','Index\IndexController@sa');
Route::post('index/index/index/index/index/sa','Index\IndexController@sa');
Route::post('index/index/index/index/index/index/sa','Index\IndexController@sa');
Route::post('index/index/index/index/index/index/index/sa','Index\IndexController@sa');
Route::post('index/index/index/index/index/index/index/index/sa','Index\IndexController@sa');
Route::get('index/lg','Index\IndexController@lg');
Route::get('index/index/index/index/index/zz','Index\IndexController@zz');
Route::get('index/index/index/index/index/zuo','Index\IndexController@zz1');
Route::get('index/index/index/index/index/index/zuo','Index\IndexController@zz1');
Route::get('index/index/index/zuo','Index\IndexController@zz1');
Route::get('index/index/index/index/zuo','Index\IndexController@zz1');
Route::get('index/st','Index\IndexController@st');





























