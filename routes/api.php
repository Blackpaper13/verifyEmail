<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register','Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('pegawai', 'Api\PegawaiController@index');
    Route::get('pegawai/{id}', 'Api\PegawaiController@show');
    Route::post('pegawai', 'Api\PegawaiController@store');
    Route::put('pegawai/{id}', 'Api\PegawaiController@update');
    Route::delete('pegawai/{id}', 'Api\PegawaiController@destroy');
    Route::get('room', 'Api\RoomController@index');
    Route::get('room/{id}', 'Api\RoomController@show');
    Route::post('room', 'Api\RoomController@store');
    Route::put('room/{id}', 'Api\RoomController@update');
    Route::delete('room/{id}', 'Api\RoomController@destroy');
    Route::get('transaction', 'Api\TransactionController@index');
    Route::get('transaction/{id}', 'Api\TransactionController@show');
    Route::post('transaction', 'Api\TransactionController@store');
    Route::put('transaction/{id}', 'Api\TransactionController@update');
    Route::delete('transaction/{id}', 'Api\TransactionController@destroy');
    
    Route::get('user/{id}', 'Api\UserController@show');
    Route::put('user/{id}', 'Api\UserController@update');
    Route::delete('user/{id}', 'Api\UserController@destroy');

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group(['namespace' => 'Api', 'as' => 'api.'], function () {

    Route::post('login', 'LoginController@login')->name('login');

    Route::post('register', 'RegisterController@register')->name('register');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('email/verify/{hash}', 'VerificationController@verify')->name('verification.verify');

        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

        Route::get('user', 'AuthenticationController@user')->name('user');

        Route::post('logout', 'LoginController@logout')->name('logout');

    });

}); */ 
//ini coba diperbaiki aku masih bingung yang verify itu.
//ini code aku coba di port lain dan dari project aku buat sendiri dari youtube
//nah coba terapin ini.
