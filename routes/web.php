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

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/', function () {
    return redirect()->route('home');
});


Route::resource('food', 'FoodController');


Route::resource('menu', 'MenuController');

Route::get('/setmenu', function () {
    return redirect()->route('menu.index');
});


Route::resource('report', 'ReportController');

Route::get('/showreport', function () {
    return redirect()->route('report.index');
});


Route::get('/welcome', 'ReportController@create');



Route::resource('user', 'UserController');


Route::resource('order', 'OrderController');