<?php

use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', 'Api\Auth\ClientController@auth');
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', 'Api\Auth\ClientController@getMe');
    Route::post('/logout', 'Api\Auth\ClientController@logout');

    Route::post('/v1/auth/orders','Api\OrderApiController@store');
    Route::get('/v1/auth/my-orders','Api\OrderApiController@myOrders');
});

Route::prefix('v1')->namespace('Api')->group(function(){
    Route::get('/tenants','TenantApiController@index');
    Route::get('/tenants/{uuid}','TenantApiController@show');
    
    Route::get('/categories','CategoryApiController@categoriesByTenant');
    Route::get('/category/{identify}','CategoryApiController@category');
    
    Route::get('/tables','TableApiController@tables');
    Route::get('/table/{identify}','TableApiController@table');
    
    Route::get('/products','ProductApiController@products');
    Route::get('/product/{identify}','ProductApiController@product');

    Route::post('/register', 'Auth\RegisterController@register');

    Route::post('/orders','OrderApiController@store');
    Route::get('/orders/{identify}','OrderApiController@order');

});
