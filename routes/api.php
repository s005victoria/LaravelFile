<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes (stateless->state zwischen request und response bleibt nicht bestehen)
|--------------------------------------------------------------------------
|stateful--> wenn id in variable im browser abgespeichert wird und abgerufen wird
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//routen werden dann auf controller weitergeleitet
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* authentification */
Route::group ([ 'middleware' => [ 'api' , 'cors']], function () {
    //Route::post ( 'auth/login' , 'Auth\ApiAuthController@login' );
    Route::post ( 'auth/login' , 'Auth\ApiAuthController@login' );
    Route::get('shopping_lists', 'ShoppingController@index');
    Route::get('shoppingList/{id}', 'ShoppingController@findById');
    Route::get('shopping_lists/{id}', 'ShoppingController@findById');
    Route::get('hallo', 'ShoppingController@hallo');
});

Route::group ([ 'middleware' => [ 'api' , 'cors', 'auth.jwt' ]], function () {
    //hier wäre authentification, funktioniert noch nicht ganz
    //hier müssten eigentlich wie hier dargestellt, eigentlich alle routen bis auf das login stehen
    Route::post('shoppingList', 'ShoppingController@save');
    Route::put( 'shoppingList/{id}' , 'ShoppingController@update' );
    Route::delete( 'shoppingList/{id}' , 'ShoppingController@delete' );
    //route to get all shoppinglists for overview and detail

});