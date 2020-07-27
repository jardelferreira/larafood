<?php

use Illuminate\Support\Facades\Auth;
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

Route::prefix('admin')->namespace('Admin\ACL')
    ->middleware('auth')
    ->group(function () {

        /**Profiles Routes */
        Route::prefix('profiles')->group(function () {

            /** Plans x Profiles */
            Route::get('{profile}/plans', 'ProfileController@plans')->name('profiles.plans');
            Route::get('{profile}/plans/{plan}/destroy', 'ProfileController@profilesPlansDestroy')->name('profiles.plans.destroy');
            /** rota any porservir para search também */
            Route::any('{profile}/plans/create', 'ProfileController@plansCreate')->name('profiles.plans.create');
            Route::post('{profile}/plans/store', 'ProfileController@profilesPlansStore')->name('profiles.plans.store');

            Route::any('/search', 'ProfileController@search')->name('profiles.search');
            Route::get('/', 'ProfileController@index')->name('profiles.index');
            Route::get('/create', 'ProfileController@create')->name('profiles.create');
            Route::post('/store', 'ProfileController@store')->name('profiles.store');
            Route::get('/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');
            Route::put('/{profile}/update', 'ProfileController@update')->name('profiles.update');
            Route::delete('/{profile}/destroy', 'ProfileController@destroy')->name('profiles.destroy');
            Route::get('/{profile}', 'ProfileController@show')->name('profiles.show');
            /**Permissions Profiles Route */

            Route::get('{profile}/permissions', 'ProfileController@permissions')->name('profiles.permissions');
            Route::get('{profile}/permissions/{permission}/destroy', 'ProfileController@profilesPermissionsDestroy')->name('profiles.permissions.destroy');
            /** rota any porservir para search também */
            Route::any('{profile}/permissions/create', 'ProfileController@permissionsCreate')->name('profiles.permissions.create');
            Route::post('{profile}/permissions/store', 'ProfileController@permissionProfileStore')->name('profiles.permissions.store');
        });
        /**Permission Routes */
        Route::prefix('permissions')->group(function () {
            /**Permissions Profiles Routes */
            Route::get('{permission}/profiles', 'PermissionController@profiles')->name('permissions.profiles');

            Route::any('/search', 'PermissionController@search')->name('permissions.search');
            Route::get('/', 'PermissionController@index')->name('permissions.index');
            Route::get('/create', 'PermissionController@create')->name('permissions.create');
            Route::post('/store', 'PermissionController@store')->name('permissions.store');
            Route::get('/{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
            Route::put('/{permission}/update', 'PermissionController@update')->name('permissions.update');
            Route::delete('/{permission}/destroy', 'PermissionController@destroy')->name('permissions.destroy');
            Route::get('/{permission}', 'PermissionController@show')->name('permissions.show');
        });
    });
Route::prefix('admin')->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        /**
         * Plans Routes
         */
        Route::prefix('plans')->group(function () {

            /** Profiles x Plans */
            Route::get('{plan}/profiles', 'PlanController@profiles')->name('plans.profiles');
            Route::get('{plan}/profiles/{profile}/destroy', 'PlanController@plansProfilesDestroy')->name('plans.profiles.destroy');
            /** rota any porservir para search também */
            Route::any('{plan}/profiles/create', 'PlanController@profilesCreate')->name('plans.profiles.create');
            Route::post('{plan:id}/profiles/store', 'PlanController@plansProfilesStore')->name('plans.profiles.store');
            /**Plans Routes */
            Route::any('/search', 'PlanController@search')->name('plans.search');
            Route::get('/', 'PlanController@index')->name('plans.index');
            Route::get('/create', 'PlanController@create')->name('plans.create');
            Route::post('/store', 'PlanController@store')->name('plans.store');
            Route::get('/{plan}/edit', 'PlanController@edit')->name('plans.edit');
            Route::get('/{plan}', 'PlanController@show')->name('plans.show');
            Route::delete('/{plan}', 'PlanController@destroy')->name('plans.destroy');
            Route::put('/{plan}', 'PlanController@update')->name('plans.update');
            /**Details Routes */
            Route::post('{plan}/details/store', 'DetailPlanController@store')->name('details.plans.store');
            Route::get('{plan}/details/create', 'DetailPlanController@create')->name('details.plans.create');
            Route::get('{plan}/details', 'DetailPlanController@index')->name('details.plans.index');
            Route::put('{plan}/details/{detail}/update', 'DetailPlanController@update')->name('details.plans.update');
            Route::get('{plan}/details/{detail}/edit', 'DetailPlanController@edit')->name('details.plans.edit');
            Route::delete('{plan}/details/{detail}/destroy', 'DetailPlanController@destroy')->name('details.plans.destroy');
            Route::get('{plan}/details/{detail}/show', 'DetailPlanController@show')->name('details.plans.show');
        });
        /**Users Routes */
        Route::prefix('users')->group(function(){
            Route::any('{user}/create', 'UserController@create')->name('users.create');
            Route::resources('','UserController');

        });
        /**
         * Admin Routes
         */
        Route::get('/', 'PlanController@index')->name('admin.index');
    });

Route::prefix('/')->namespace('Site')->group(function(){
    Route::get('','SiteController@index')->name('site.index');
    Route::get('plan/{plan}','SiteController@plan')->name('plan.subscription');
});

Auth::routes();
