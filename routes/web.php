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

Route::get('/', function () {
     return view('welcome');
 });
 Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

//ログイン中のページ
Route::middleware('auth.custom')->group(function () {
    // トップページ
    Route::get('/top','PostsController@index');
    Route::get('/profile','UsersController@profile');
    // 検索
    Route::get('/search','UsersController@index');
    Route::post('/search','UsersController@search');
    // フォロー・フォロワー
    Route::post('/follow', 'FollowsController@follow');
    Route::post('/unfollow', 'FollowsController@unfollow');
    // Route::get('/follow-list','PostsController@index');
    Route::get('/followList', 'UsersController@followList');
    // Route::get('/follower-list','PostsController@index');
    Route::get('/followerList', 'UsersController@followerList');
    // ユーザープロフィールページ
    Route::get('/profile/{id}', 'UsersController@showProfile');
    Route::get('/profile', 'UsersController@show');
    Route::post('/profile/update', 'UsersController@update');
    // ログアウト
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
    // 投稿・削除
    Route::post('post/create', 'PostsController@create');
    Route::delete('post/{id}/delete', 'PostsController@delete');
    Route::post('post/update', 'PostsController@update');
});