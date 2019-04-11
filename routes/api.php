<?php

use App\User;
use Illuminate\Http\Request;
use App\fakeUser;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    // return $request->user();
//    return $request->all();
//});

Route::middleware('auth:api')->get('/user/prime', function (Request $request) {
     return App\User::orderBy('id', 'desc')->paginate(5);
});

Route::middleware('auth:api')->post('/user/cygnus', function (Request $request) {
    return Auth::id();
});

Route::get('user/profile', 'API\UserController@profile');
Route::put('user/updateprofile', 'API\UserController@updateProfile');
Route::apiResource('user', 'API\UserController');