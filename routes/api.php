<?php

//use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('login-slider','Api\AuthController@SliderLogin');
Route::get('login-image','Api\AuthController@loginImage');
Route::get('signup-image','Api\AuthController@signupImage');
Route::get('category','Api\HomeController@getCategory');
Route::get('home-slider','Api\HomeController@homeSlider');
Route::get('brand-slider','Api\HomeController@brandList');
Route::get('today-product','Api\HomeController@todayProduct');
Route::get('get-location','Api\AuthController@getLocation');
