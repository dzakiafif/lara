<?php

use Illuminate\Http\Request;

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

Route::get('test','API\APILoginCOntroller@test');

Route::post('login','API\APILoginController@index');
Route::post('register','API\APILoginController@register');

Route::middleware('auth.login')->group(function () {
   Route::get('user','API\APIUserController@index');
});
