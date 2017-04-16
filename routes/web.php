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

    Route::get('/programs/create', 'ProgramController@create')->name('program.create');
    Route::posT('/programs/storePDF', 'ProgramController@storeFromPDF')->name('program.storeFromPDF');
    Route::get('/programs/catalog', 'ProgramController@catalog')->name('program.catalog');
    Route::post('/programs/select', 'ProgramController@select')->name('program.select');
    Route::get('/{id}', 'ProgramController@show')->where('id', '[0-9]+')->name('program.show');
    Route::get('/{id}/excel', 'ProgramController@excel')->where('id', '[0-9]+')->name('program.excel');
});
