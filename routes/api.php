<?php

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Fragment\RoutableFragmentRenderer;

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

Route::apiResource("spell-lists", 'SpellListController');
Route::apiResource("spells", 'SpellController');
Route::apiResource('users', 'User\UserController');
Route::apiResource('characters', 'CharacterController');
Route::apiResource('campaigns', 'CampaignsController');
Route::apiResource('campaigns.adventures', 'AdventuresController');
Route::apiResource('spell-lists.spells', 'SpellsNestedController');

Route::prefix('auth')->group(function() {
    Route::resource('sessions', 'Api\Auth\SessionsController')->only(['store']);
    Route::middleware('auth:jwt')->group(function() {
        Route::resource('refreshments', 'Api\Auth\RefreshmentsController')->only(['store']);
        Route::get('session', 'Api\Auth\SessionController@show');
        Route::delete('session', 'Api\Auth\SessionController@destroy');
    });
});

Route::get('/roll', 'DiceController@roll');
Route::prefix('xp')->group(function () {
    Route::get('maneuver', 'XPController@getManeuverXP');
    Route::get('spell', 'XPController@getSpellXP');
    Route::get('travel', 'XPController@getTravelOrHPXP');
    Route::get('hp', 'XPController@getTravelOrHPXP');
    Route::get('critical', 'XPController@getCriticalXP');
    Route::get('kill', 'XPController@getKillXP');
    Route::get('bonus', 'XPController@getBonusXP');
});


