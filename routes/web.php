<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('admin')->namespace('Admin\ACL')->group(function(){
/**Profiles Routes */
Route::prefix('profiles')->group(function(){
    Route::any('/search','ProfileController@search')->name('profiles.search');
    Route::get('/','ProfileController@index')->name('profiles.index');
    Route::get('/create','ProfileController@create')->name('profiles.create');
    Route::post('/store','ProfileController@store')->name('profiles.store');
    Route::get('/{profile}/edit','ProfileController@edit')->name('profiles.edit');
    Route::put('/{profile}/update','ProfileController@update')->name('profiles.update');
    Route::delete('/{profile}/destroy','ProfileController@destroy')->name('profiles.destroy');
    Route::get('/{profile}','ProfileController@show')->name('profiles.show');
    /**Permissions Profiles Route */

    Route::get('{profile}/permissions','ProfileController@permissions')->name('profiles.permissions');
    Route::get('{profile}/permissions/create','ProfileController@permissionsCreate')->name('profiles.permissions.create');
    Route::post('{profile}/permissions/store','ProfileController@permissionProfileStore')->name('profiles.permissions.store');
});
/**Permission Routes */
Route::prefix('permissions')->group(function(){
    Route::any('/search','PermissionController@search')->name('permissions.search');
    Route::get('/','PermissionController@index')->name('permissions.index');
    Route::get('/create','PermissionController@create')->name('permissions.create');
    Route::post('/store','PermissionController@store')->name('permissions.store');
    Route::get('/{permission}/edit','PermissionController@edit')->name('permissions.edit');
    Route::put('/{permission}/update','PermissionController@update')->name('permissions.update');
    Route::delete('/{permission}/destroy','PermissionController@destroy')->name('permissions.destroy');
    Route::get('/{permission}','PermissionController@show')->name('permissions.show');
});
});
Route::prefix('admin')->namespace('Admin')->group(function(){
    /**
     * Plans Routes
     */
 Route::prefix('plans')->group(function(){
    /**Details Routes */
    Route::post('{plan}/details/store', 'DetailPlanController@store')->name('details.plans.store');
    Route::get('{plan}/details/create', 'DetailPlanController@create')->name('details.plans.create');
    Route::get('{plan}/details', 'DetailPlanController@index')->name('details.plans.index');
    Route::put('{plan}/details/{detail}/update', 'DetailPlanController@update')->name('details.plans.update');
    Route::get('{plan}/details/{detail}/edit', 'DetailPlanController@edit')->name('details.plans.edit');
    Route::delete('{plan}/details/{detail}/destroy', 'DetailPlanController@destroy')->name('details.plans.destroy');
    Route::get('{plan}/details/{detail}/show', 'DetailPlanController@show')->name('details.plans.show');
    /**Plans Routes */
     Route::any('/search','PlanController@search')->name('plans.search');
     Route::get('/', 'PlanController@index')->name('plans.index');
     Route::get('/create', 'PlanController@create')->name('plans.create');
     Route::post('/store', 'PlanController@store')->name('plans.store');
     Route::get('/{plan}/edit', 'PlanController@edit')->name('plans.edit');
     Route::get('/{plan}', 'PlanController@show')->name('plans.show');
     Route::delete('/{plan}', 'PlanController@destroy')->name('plans.destroy');
     Route::put('/{plan}', 'PlanController@update')->name('plans.update');
 });
 /**
  * Admin Routes
  */
 Route::get('/','PlanController@index')->name('admin.index');
 
});


Route::get('/', function () {
    return view('welcome');
});
