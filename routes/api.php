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

// flutter_api/admin/login

Route::group(['middleware' => 'checkPassword'],function () {

    Route::group(['prefix' => 'admin','namespace' => 'Admin'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:admin-api');
    });

    Route::group(['prefix' => 'customer','namespace' => 'Customer'],function () {
        Route::post('login','loginController@login');

    });

});

Route::group(['prefix'=>'customer','middleware' => ['checkPassword','assign.guard:customer-api']],function () {
    Route::post('/profile',function(){
        return \Auth::user();
    });
});
