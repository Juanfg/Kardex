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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', function () {
        if (Auth::guest())
            return redirect()->route('login');
        return view('home');
    });

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/pdf', 'PDFController@create')->name('pdf.create');
    Route::post('/pdf/store', 'PDFController@store')->name('pdf.store');

    Route::get('/{id}', 'ProgramController@show')->name('program.show');
    Route::get('/{id}/excel', 'ProgramController@excel')->name('program.excel');
});
