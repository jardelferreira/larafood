<?php

use Illuminate\Support\Facades\Route;

Route::get('/tenants','Api\TenantApiController@index');
Route::get('/tenants/{uuid}','Api\TenantApiController@show');

Route::get('/categories','Api\CategoryApiController@categoriesByTenant');
Route::get('/category/{url}','Api\CategoryApiController@category');

Route::get('/tables','Api\TableApiController@tables');
Route::get('/table/{identify}','Api\TableApiController@table');