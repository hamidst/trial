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

Route::post('/team','HttpCreateteam@__invoke')->name('team.create');
Route::get('/league/teams/{league_id}','HttpGetLeagueteams@__invoke')->name('league.get.teams');
Route::get('/league/week/{week_id}','HttpGetWeekMatches@__invoke')->name('league.week.matches');
Route::get('/league/all','HttpGetAllMatches@__invoke')->name('league.matches');

