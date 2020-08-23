<?php

use Illuminate\Support\Facades\Route;

Route::get('/tenants','Api\TenantApiController@index');
