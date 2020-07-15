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
