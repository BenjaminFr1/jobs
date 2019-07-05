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

Route::get('/', 'IndexController@index');

Route::post('/', 'IndexController@invoiceJob');

Route::post('/add', 'IndexController@addJob');

Route::post('/addaction', 'IndexController@addAction');

Route::get('/listAction', 'IndexController@listAction');

Route::post('/updateComplete', 'IndexController@updateComplete');

Route::post('/modifyTask', 'IndexController@modifyTask');
