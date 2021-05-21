<?php

use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
});

Route::group(['middleware' => 'role:admin'],  function(){
    Route::prefix('teacher')->group(function (){
        Route::get('/', 'TeacherController@index')->name('teacher');
        Route::get('create', 'TeacherController@create');
        Route::post('/', 'TeacherController@store');        
        Route::get('{teacher}/delete', 'TeacherController@destroy');
    });
    Route::prefix('master')->group(function(){
        Route::prefix('home')->group(function(){
            Route::get('/', 'HomeController@index')->name('master.home');
            Route::post('/', 'HomeController@store');
            Route::get('/create', 'HomeController@create')->name('master.home.create');
            Route::get('/{home}/delete', 'HomeController@destroy');
            Route::get('/{home}/edit', 'HomeController@edit');
            Route::post('/{home}/update', 'HomeController@update');
        });

        Route::prefix('class')->group(function(){
            Route::get('/', 'MasterClassController@index')->name('master.class');
        });

        Route::prefix('grade')->group(function(){
            Route::get('/', 'GradeController@tableGrade')->name('master.grade');
            Route::post('/', 'GradeController@store')->name('master.grade.store');
            Route::get('/{grade}/edit', 'GradeController@edit')->name('master.grade.edit');
        });
    });
    
});
Route::group(['middleware' => 'role:admin,teacher'],  function(){
    Route::prefix('student')->group(function(){
        Route::get('/', 'StudentController@index')->name('student');
        Route::get('create', 'StudentController@create');
        Route::post('/', 'StudentController@store');
        Route::get('{student}/edit', 'StudentController@edit');
        Route::post('{student}', 'StudentController@update');
        Route::get('{student}/delete', 'StudentController@destroy');
        Route::post('tablestudent', 'StudentController@table')->name('tablestudent');
    });
    Route::prefix('course')->group(function(){
        Route::get('/', 'CourseController@index')->name('course');
        Route::post('/', 'CourseController@store')->name('course.store');
        Route::get('/{course}/edit', 'CourseController@edit')->name('course.edit');
        Route::get('/{course}/delete', 'CourseController@destroy')->name('course.destroy');
    });
    Route::prefix('teacher')->group(function (){
        Route::get('{teacher}/edit', 'TeacherController@edit');
        Route::post('{teacher}', 'TeacherController@update');
    });
});

?>