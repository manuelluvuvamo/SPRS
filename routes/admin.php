<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->namespace('Admin')->group(function () {

    route::get('/', ['as' => 'admin.dash', 'uses' => 'HomeController@dash']);
   
});



Route::middleware(['auth'])->group(function () {

    /* START USER */
    Route::middleware(['entity'])->prefix('user')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
            route::get('create', ['as' => 'admin.user.create', 'uses' => 'UserController@create'])->middleware(['admin']);
            route::post('store', ['as' => 'admin.user.store', 'uses' => 'UserController@store'])->middleware(['admin']);
            route::get('edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit']);
            route::post('update/{id}', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
            route::get('destroy/{id}', ['as' => 'admin.user.destroy', 'uses' => 'UserController@destroy'])->middleware(['admin']);
            route::get('purge/{id}', ['as' => 'admin.user.purge', 'uses' => 'UserController@purge'])->middleware(['admin']);

        }
    );

    /* END USER */

    /* START ENTITY */
    Route::middleware(['entity'])->prefix('entity')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.entity.index', 'uses' => 'EntityController@index']);
            route::get('create', ['as' => 'admin.entity.create', 'uses' => 'EntityController@create'])->middleware(['admin']);
            route::post('store', ['as' => 'admin.entity.store', 'uses' => 'EntityController@store'])->middleware(['admin']);
            route::get('edit/{id}', ['as' => 'admin.entity.edit', 'uses' => 'EntityController@edit'])->middleware(['admin']);
            route::post('update/{id}', ['as' => 'admin.entity.update', 'uses' => 'EntityController@update'])->middleware(['admin']);
            route::get('destroy/{id}', ['as' => 'admin.entity.destroy', 'uses' => 'EntityController@destroy'])->middleware(['admin']);
            route::get('purge/{id}', ['as' => 'admin.entity.purge', 'uses' => 'EntityController@purge'])->middleware(['admin']);

        }
    );
    /* END ENTITY */


   

    /* START REFERENCE */
    Route::middleware(['admin'])->prefix('reference')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.reference.index', 'uses' => 'ReferenceController@index']);
            route::get('create', ['as' => 'admin.reference.create', 'uses' => 'ReferenceController@create']);
            route::post('store', ['as' => 'admin.reference.store', 'uses' => 'ReferenceController@store']);
            route::get('edit/{id}', ['as' => 'admin.reference.edit', 'uses' => 'ReferenceController@edit']);
            route::post('update/{id}', ['as' => 'admin.reference.update', 'uses' => 'ReferenceController@update']);
            route::get('destroy/{id}', ['as' => 'admin.reference.destroy', 'uses' => 'ReferenceController@destroy']);
            route::get('purge/{id}', ['as' => 'admin.reference.purge', 'uses' => 'ReferenceController@purge']);
            route::get('pay/{id}', ['as' => 'admin.reference.pay', 'uses' => 'ReferenceController@pay']);
        }
    );
    /* END REFERENCE */

     /* START PAYMENT */
     Route::middleware(['admin'])->prefix('payment')->namespace('Admin')->group(
        function () {
            route::get('index', ['as' => 'admin.payment.index', 'uses' => 'PaymentController@index']);
            route::get('index2', ['as' => 'admin.payment.index2', 'uses' => 'PaymentController@index2']);
        }
    );
    /* END PAYMENT */



    /* START LOGS */
    Route::middleware(['admin'])->prefix('log')->namespace('Admin')->group(
        function () {
            route::get('search', ['as' => 'admin.log.search', 'uses' => 'LogController@search']);
            route::post('index', ['as' => 'admin.log.index', 'uses' => 'LogController@index']);
            Route::get('/search/print', ['as' => 'admin.log.search.print', 'uses' => 'LogController@searchPrint']);
            route::post('print', ['as' => 'admin.log.print', 'uses' => 'LogController@print']);

        }
    );
    /* END LOGS */
   
});