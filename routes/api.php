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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('users', 'User\UserController');
Route::get('/roll', 'DiceController@roll');
Route::get('/xp/maneuver', 'XPController@getManeuverXP');
Route::get('/xp/spell', 'XPController@getSpellXP');
Route::get('/xp/travel', 'XPController@getTravelOrHPXP');
Route::get('/xp/hp', 'XPController@getTravelOrHPXP');
Route::get('/xp/critical', 'XPController@getCriticalXP');
Route::get('/xp/kill', 'XPController@getKillXP');
Route::get('/xp/bonus', 'XPController@getBonusXP');
