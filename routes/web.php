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
	$data = array(
		[
			'id' => 1,
			'name' => 'Mah',
			'options' => [11, 12, 13, 14]
		],
		[
			'id' => 2,
			'name' => 'Mah2',
			'options' => [21, 22, 23, 24]
		],
		[
			'id' => 3,
			'name' => 'Mah3',
			'options' => [31, 32, 33, 34]
		]
	);
    return view('test', compact('data'));
});

Route::post('/message', 'MessageController@post');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
