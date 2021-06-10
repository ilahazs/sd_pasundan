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

Route::get('/', 'HomeController@index')->name('homepage');
Route::get('/login', 'AuthController@login')->name('login')->middleware('guest');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => 'auth'],  function(){
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function (){
            require_once(dirname(__FILE__).'/admin.php');
    });
    Route::group(['prefix' => 'profile'], function (){
        Route::get('myProfile', 'ProfileController@myProfile')->name('myProfile');
    });
});