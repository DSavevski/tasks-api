<?php

use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('user', function (Request $request) {
    return Auth::user();
});

Route::post('tokensignin', 'GoogleLoginController@getSignInToken');
Route::post('signout', 'GoogleLoginController@signOut');

Route::get('tasks/daily/{date}', 'TaskController@dailyTasks');
Route::get('tasks/weekly/{date}', 'TaskController@weeklyTasks');

Route::apiResource('tasks', 'TaskController');
Route::apiResource('categories', 'CategoryController');
