<?php

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

Route::get('login', 'Auth\LoginController@loginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.submit');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::resource('content', 'ContentController');

Route::group(['namespace' => 'Page'], function () {
    Route::get('welcome', 'PagesController@welcome');
    Route::get('/', 'PagesController@home')->name('home');
});
