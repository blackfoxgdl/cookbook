<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::get('recipes', 'App\Http\Controllers\RecipesController@index');


Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/recipes', 'App\Http\Controllers\RecipesController@store');
    Route::post('/recipes/{id}', 'App\Http\Controllers\ReccipesController@update');
    Route::get('/feedback', 'App\Http\Controllers\FeedbackController@inndex');
    Route::post('')
});
