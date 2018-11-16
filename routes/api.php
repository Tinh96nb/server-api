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
Route::group([
  'namespace' => 'v1',
  'prefix' => 'v1',
],function () {

    Route::post('auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@login');

    Route::post('password/create', 'PasswordResetController@create');
    Route::get('password/find/{token}', 'PasswordResetController@find');
    Route::post('password/reset', 'PasswordResetController@reset');
    // article view
    Route::get('articles', 'ArticleController@index');
    Route::get('articles/{id}', 'ArticleController@show');
    
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('auth/verify-user', 'AuthController@verifyUser');
        Route::post('auth/refresh', 'AuthController@refresh');
        Route::post('auth/logout', 'AuthController@logout');

        Route::post('articles', 'ArticleController@store');
        Route::put('articles/{id}', 'ArticleController@update');
        Route::delete('articles/{id}', 'ArticleController@delete');
        });
});
