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

if (! function_exists("pureApiRoute")) {
    function pureApiRoute($route) {
        return $route->except(['create', 'edit']);
    }
}

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

pureApiRoute(Route::resource("spell-lists", 'SpellListController'));
pureApiRoute(Route::resource("spells", 'SpellController'));
pureApiRoute(Route::resource('users', 'User\UserController'));
pureApiRoute(Route::resource('characters', 'CharacterController'));

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


