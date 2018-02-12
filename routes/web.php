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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'ThreadsController@index')->name('threads.index');
Route::get('/threads/{thread}', 'ThreadsController@show')->name('threads.show');
Route::post('/threads', 'ThreadsController@store')->name('threads.store');
Route::post('/threads/{thread}/replies', 'RepliesController@store')->name('reply.store');

Route::get('/users/{user}', 'HomeController@show')->name('users.show');


