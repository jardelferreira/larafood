<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->namespace('Api')->group(function(){
    Route::get('/tenants','TenantApiController@index');
    Route::get('/tenants/{uuid}','TenantApiController@show');
    
    Route::get('/categories','CategoryApiController@categoriesByTenant');
    Route::get('/category/{url}','CategoryApiController@category');
    
    Route::get('/tables','TableApiController@tables');
    Route::get('/table/{identify}','TableApiController@table');
    
    Route::get('/products','ProductApiController@products');
    Route::get('/product/{flag}','ProductApiController@product');

    Route::post('/register', 'Auth\\RegisterController@register');

});
