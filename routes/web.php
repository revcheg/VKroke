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

Route::get('/', [
    'uses' => '\VKroke\Http\Controllers\HomeController@index',
    'as' => 'home', 
]);

Route::get('/alert', function () {
    return redirect()->route('home')->with('info', 'Вы успешно зарегистрированы!');
});

Route::get('/signup', [
    'uses' => '\VKroke\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
]);

Route::post('/signup', [
    'uses' => '\VKroke\Http\Controllers\AuthController@postSignup',
]);

Route::get('/signin', [
    'uses' => '\VKroke\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
]);

Route::post('/signin', [
    'uses' => '\VKroke\Http\Controllers\AuthController@postSignin',
]);

Route::get('/signout', [
    'uses' => '\VKroke\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);

Route::get('/search', [
    'uses' => '\VKroke\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
]);

Route::get('/user/{username}', [
    'uses' => '\VKroke\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
]);

Route::get('/profile/edit', [
    'uses' => '\VKroke\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
]);

Route::post('/profile/edit', [
    'uses' => '\VKroke\Http\Controllers\ProfileController@postEdit',
]);

Route::get('/friends', [
    'uses' => '\VKroke\Http\Controllers\FriendController@getIndex',
    'as' => 'friend.index',
]);

Route::get('/friends/add/{username}', [
    'uses' => '\VKroke\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
]);

Route::get('/friends/accept/{username}', [
    'uses' => '\VKroke\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
]);

Route::post('/status', [
    'uses' => '\VKroke\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
]);

Route::post('/status/{statusId}/reply', [
    'uses' => '\VKroke\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply',
]);