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
Route::resource('tag', 'TagsController')->only('index', 'show');

Route::get('/', 'Page\PagesController@home')->name('home');
Route::get('/welcome', 'Page\PagesController@welcome')->name('page.welcome');
Route::get('/about', 'Page\PagesController@about')->name('page.about');
Route::resource('page', 'Page\PagesController')->except('destroy', 'create', 'store');

Route::post('file-uploads', 'File\UploadsController@uploads')->name('file.uploads');
