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
//ログイン機能
Auth::routes();
Route::get('/home', 'HomeController@home')->name('home');
//インデックスページ
Route::get('/', 'PhotripController@index');
//カテゴリーページ
Route::get('/category/{category_id}', 'PhotripController@category');
//投稿フォームページ
Route::get('/post', 'PhotripController@showCreateForm')->name('posts.create');
Route::post('/post', 'PhotripController@create');
//投稿確認ページ
Route::get('/post/{post}', 'PhotripController@detail')->name('posts.detail');
//編集ページ
Route::get('/post/{post}/edit','PhotripController@edit')->name('posts.edit');
Route::patch('/post/{post}','PhotripController@update');
//画像ページ
Route::get('/phot/{post}', 'PhotripController@phot')->name('posts.phot');
//削除機能
Route::post('/post/delete/{id}', 'PhotripController@delete');
//ajax
Route::get('/create/get_json', 'PhotripController@ajax_get_json');
//hokkaidou
Route::get('/area/1', 'PhotripController@hokkaidou');
//touhoku
Route::get('/area/2', 'PhotripController@touhoku');
//kantou
Route::get('/area/3', 'PhotripController@kantou');
//tyubu
Route::get('/area/4', 'PhotripController@tyubu');
//kinki
Route::get('/area/5', 'PhotripController@kinki');
//tyugoku
Route::get('/area/6', 'PhotripController@tyugoku');
//shikoku
Route::get('/area/7', 'PhotripController@shikoku');
//kyusyu
Route::get('/area/8', 'PhotripController@kyusyu');
