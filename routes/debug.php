<?php

use Illuminate\Support\Facades\Route;

Route::any('/{function?}', 'DebugController@index')->middleware('auth');
