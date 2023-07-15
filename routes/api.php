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
| flutter_api/admin/login
| Note Regardings the admin this is watershop.
| Note Regardings the customer this is a customer table.
| Note Regardings the delevary driver.
|
*/


Route::group(['middleware' => 'checkPassword'],function () {

    Route::group(['prefix' => 'watershop','namespace' => 'Admin'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:admin-api');

    });

    Route::group(['prefix' => 'customer','namespace' => 'Customer'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:customer-api');

    });

    Route::group(['prefix' => 'delivery','namespace' => 'Delivery'],function () {
        Route::post('login','loginController@login');
        Route::post('logout','loginController@logout')->middleware('assign.guard:delivery-api');

    });

});

//watershop
Route::group(['prefix'=>'watershop','namespace' => 'Admin','middleware' => ['checkPassword','assign.guard:admin-api']],function () {
    
    Route::group(['prefix' => 'profile'],function(){
        Route::post('/','createWatershopController@profile');
    });
    
    Route::group(['prefix' => 'delivery'],function(){
        Route::post('/insert','addDeleviryController@setDelivery');
        Route::post('/view','addDeleviryController@getDelivery');
        Route::post('/edit/{id}','addDeleviryController@editDelivery');
        Route::post('/delete/{id}','addDeleviryController@deleteDelivery');
        Route::post('/update/{id}','addDeleviryController@updateDelivery');
    });
 
    Route::group(['prefix' => 'orders'],function(){
        Route::post('/','ordersController@getOrdersForWaterShop');
        Route::post('/send_order_to_delivery','ordersController@getOrdersForWaterShop');
    });

    Route::group(['prefix' => 'products'],function(){
        Route::post('/insert','productsController@insert');
        Route::post('/view','productsController@get');
        Route::post('/edit/{id}','productsController@edit');
        Route::post('/delete/{id}','productsController@delete');
        Route::post('/update/{id}','productsController@update');
    });

});

//customer
Route::group(['prefix'=>'customer','middleware' => ['checkPassword','assign.guard:customer-api']],function () {
    Route::post('/profile',function(){
        return \Auth::user();
    });
});

//delivery
Route::group(['prefix'=>'delivery','middleware' => ['checkPassword','assign.guard:delivery-api']],function () {
    Route::post('/profile',function(){
        return \Auth::user();
    });
    

});
