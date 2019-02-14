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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
	return view('login');
})->name('login');

Route::post('/auth/login', 'AuthController@login');
Route::get('/auth/logout', 'AuthController@logout')->middleware('auth');

Route::get('/notas', function () {
	return view('notas');
})->middleware('auth');

Route::group(['prefix' => 'notas', 'middleware' => 'auth'], function() {
	Route::get('/all', 'NotasController@all');
	Route::get('/find/{id}', 'NotasController@find');
	Route::post('/new', 'NotasController@new');
	Route::put('/edit/{id}', 'NotasController@edit');
	Route::put('/delete/{id}', 'NotasController@delete');
});
