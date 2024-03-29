<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home.index');

Route::get('/movies', 'App\Http\Controllers\MovieController@index')->name('movies.index');
Route::get('/movie/{id}', 'App\Http\Controllers\MovieController@show')->name('movies.show');

Route::get('/serials', 'App\Http\Controllers\SerialController@index')->name('serials.index');
Route::get('/serial/{serial}', 'App\Http\Controllers\SerialController@show')->name('serials.show');

Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news.index');
Route::get('/new/{new}', 'App\Http\Controllers\NewsController@show')->name('news.show');

