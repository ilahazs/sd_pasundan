<?php

use Illuminate\Support\Facades\Route;


Route::prefix('student')->group(function(){
    Route::get('/', 'StudentController@index')->name('student');
    Route::get('create', 'StudentController@create');
    Route::post('/', 'StudentController@store');
    Route::get('{student}/edit', 'StudentController@edit');
    Route::post('{student}', 'StudentController@update');
    Route::get('{student}/show', 'StudentController@show');
    Route::get('{student}/delete', 'StudentController@destroy');
    Route::post('tablestudent', 'StudentController@tableSiswa')->name('tablestudent');
});

Route::prefix('teacher')->group(function (){
    Route::get('/', 'TeacherController@index')->name('teacher');
    Route::get('create', 'TeacherController@create');
    Route::post('/', 'TeacherController@store');
    Route::get('{teacher}/edit', 'TeacherController@edit');
    Route::post('{teacher}', 'TeacherController@update');
    Route::get('{teacher}/delete', 'TeacherController@destroy');
});

Route::prefix('master')->group(function(){
    Route::get('home', 'HomeController@index')->name('home');
    Route::post('home', 'HomeController@store');
    Route::get('home/create', 'HomeController@create')->name('home.create');
    Route::get('home/{home}/delete', 'HomeController@destroy');
    Route::get('home/{home}/edit', 'HomeController@edit');
    Route::post('home/{home}/update', 'HomeController@update');
});

Route::prefix('dashboard')->group(function(){
    Route::get('/', 'DashboardController@index');
});

?>