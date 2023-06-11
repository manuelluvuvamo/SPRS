<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth.api'])->group(function () {

    /* START REFERENCES */
    Route::namespace('Api')->group(
        function () {
            route::get('/references', 'ReferenceController@index');
            route::post('/references/{reference}', 'ReferenceController@store');
            route::get('/references/{reference}', 'ReferenceController@show');
            route::put('/references/{reference}', 'ReferenceController@update');
            route::delete('/references/{reference}', 'ReferenceController@destroy');
            route::post('/reference_ids', 'ReferenceController@reference_ids');
        }
    );

    /* END REFERENCES */


    /* START PAYMENTS */
    Route::namespace('Api')->group(
        function () {
            route::get('/payments', 'PaymentController@index');
            route::delete('/payments/{id}', 'PaymentController@destroy');
        }
    );

    /* END PAYMENTS */
});
