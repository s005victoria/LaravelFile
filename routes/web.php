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

//hier verweisen wir auf den controller
Route::get('/', 'ShoppingController@index');

//shoppingslists overview
Route::get('/shopping_lists', 'ShoppingController@index');
//detailview of a list
Route::get('/shopping_lists/{shoppingList}', 'ShoppingController@show');
//Test
//Route::get('hallo', 'ShoppingController@hallo');

