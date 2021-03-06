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
Route::resource('tweets', 'TweetController')->middleware('auth');
//Route::get('tweets', 'TweetController@index')->name('tweets.index');
//Route::get('tweets/create', 'TweetController@create')->name('tweets.create');
//Route::post('tweets', 'TweetController@store')->name('tweets.store');
//Route::get('tweets/{$tweet}', 'TweetController@show')->name('tweets.show');
//Route::get('tweets/{$tweet}/edit', 'TweetController@edit')->name('tweets.edit');
//Route::post('tweets/{$tweet}', 'TweetController@update')->name('tweets.update');
//Route::post('tweets/{$tweet}', 'TweetController@destroy')->name('tweets.destroy');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Route::post('tweets/{tweet}/comment', 'TweetController@comment')->name('tweets.comment');
Route::get('tweets/{tweet}/ajax', 'TweetController@showAjax');
