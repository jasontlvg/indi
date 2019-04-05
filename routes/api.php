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
//     return fakeUser::all();
//    $fakeUser= new fakeUser();

     return App\User::paginate(5);
//     return App\User::all();
});

Route::middleware('auth:api')->post('/user/cygnus', function (Request $request) {
//    return $request->all();
    return Auth::id();
});

//Route::apiResources(['user' => 'API\UserController']);
Route::apiResource('user', 'API\UserController');