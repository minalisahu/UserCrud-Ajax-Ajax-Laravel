<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home','HomeController@index')->name('home');
Route::get('/user-list','HomeController@userList')->name('user.list');
Route::get('/create','HomeController@create')->name('user.create');
Route::post('/store','HomeController@store')->name('user.store');
Route::put('/update', 'HomeController@update')->name('user.update')->where('id', '[0-9]+');
Route::get('/{user}/show', 'HomeController@show')->name('user.show')->where('id', '[0-9]+');
Route::get('/{user}/edit', 'HomeController@edit')->name('user.edit')->where('id', '[0-9]+');
Route::get('/{user}/delete', 'HomeController@destroy')->name('user.destroy')->where('id', '[0-9]+');
