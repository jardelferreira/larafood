<?php

use App\Models\Client;
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
Route::get('teste', function () {
    $client = Client::first();
    $token = $client->createToken('token-teste');
    dd($token->plainTextToken);
});

Route::prefix('admin')->namespace('Admin\ACL')
    ->middleware('auth')
    ->group(function () {
        /**Roles x Users Routes */
        Route::prefix('users')->group(function(){
            Route::get('{user}/roles', 'RoleUserController@roles')->name('users.roles');
            Route::get('{user}/roles/{role}/destroy', 'RoleUserController@rolesUsersDestroy')->name('users.roles.destroy');
            /** rota any porservir para search também */
            Route::any('{user}/roles/create', 'RoleUserController@rolesUsersCreate')->name('users.roles.create');
            Route::post('{user}/roles/store', 'RoleUserController@rolesUsersStore')->name('users.roles.store');
        });

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
        /**Roles Routes */
        Route::prefix('roles')->group(function () {

            Route::any('/search', 'RoleController@search')->name('roles.search');
            Route::get('/', 'RoleController@index')->name('roles.index');
            Route::get('/create', 'RoleController@create')->name('roles.create');
            Route::post('/store', 'RoleController@store')->name('roles.store');
            Route::get('/{role}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('/{role}/update', 'RoleController@update')->name('roles.update');
            Route::delete('/{role}/destroy', 'RoleController@destroy')->name('roles.destroy');
            Route::get('/{role}', 'RoleController@show')->name('roles.show');
            /**Permissions x Roles Route */

            Route::get('{role}/permissions', 'RoleController@permissions')->name('roles.permissions');
            Route::get('{role}/permissions/{permission}/destroy', 'RoleController@rolesPermissionsDestroy')->name('roles.permissions.destroy');
            /** rota any porservir para search também */
            Route::any('{role}/permissions/create', 'RoleController@rolesPermissionsCreate')->name('roles.permissions.create');
            Route::post('{role}/permissions/store', 'RoleController@rolesPermissionsStore')->name('roles.permissions.store');
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
        Route::prefix('users')->name('users.')->group(function(){
            Route::get('/','UserController@index')->name('index');
            Route::get('/create','UserController@create')->name('create');
            Route::get('/{user}/edit','UserController@edit')->name('edit');
            Route::post('/store','UserController@store')->name('store');
            Route::delete('/{user}/destroy','UserController@destroy')->name('destroy');
            Route::put('/{user}/update','UserController@update')->name('update');
            Route::get('/{user}','UserController@show')->name('show');
            Route::any('/search', 'UserController@search')->name('search');

        });
        /**categories Routes */
        Route::prefix('categories')->name('categories.')->group(function(){
            Route::get('/','CategoryController@index')->name('index');
            Route::get('/create','CategoryController@create')->name('create');
            Route::get('/{category}/edit','CategoryController@edit')->name('edit');
            Route::post('/store','CategoryController@store')->name('store');
            Route::delete('/{category}/destroy','CategoryController@destroy')->name('destroy');
            Route::put('/{category}/update','CategoryController@update')->name('update');
            Route::get('/{category}','CategoryController@show')->name('show');
            Route::any('/search', 'CategoryController@search')->name('search');

        });
        /**tables Routes */
        Route::prefix('tables')->name('tables.')->group(function(){
            Route::get('/','TableController@index')->name('index');
            Route::get('/create','TableController@create')->name('create');
            Route::get('/{table}/edit','TableController@edit')->name('edit');
            Route::post('/store','TableController@store')->name('store');
            Route::delete('/{table}/destroy','TableController@destroy')->name('destroy');
            Route::put('/{table}/update','TableController@update')->name('update');
            Route::get('/{table}','TableController@show')->name('show');
            Route::any('/search', 'TableController@search')->name('search');

        });
        /**products Routes */
        Route::prefix('products')->name('products.')->group(function(){
            Route::get('/','ProductController@index')->name('index');
            Route::get('/create','ProductController@create')->name('create');
            Route::get('/{product}/edit','ProductController@edit')->name('edit');
            Route::post('/store','ProductController@store')->name('store');
            Route::delete('/{product}/destroy','ProductController@destroy')->name('destroy');
            Route::put('/{product}/update','ProductController@update')->name('update');
            Route::get('/{product}','ProductController@show')->name('show');
            Route::any('/search', 'ProductController@search')->name('search');
            /** Products x Categories */
            Route::get('{product}/categories', 'CategoryProductController@categories')->name('categories');
            Route::get('{product}/categories/{category}/destroy', 'CategoryProductController@detachCategoriesProduct')->name('categories.destroy');
            /** rota any porservir para search também */
            Route::any('{product}/categories/create', 'CategoryProductController@categoriesProductCreate')->name('categories.create');
            Route::post('{product}/categories/store', 'CategoryProductController@attachCategoriesProduct')->name('categories.store');

        });
        /**
         * Admin Routes
         */
        Route::get('/', 'PlanController@index')->name('admin.index');
        /**
         * Tenant Routes
         */
        Route::prefix('tenants')->name('tenants.')->group(function(){
            Route::get('/','TenantController@index')->name('index');
            Route::get('/create','TenantController@create')->name('create');
            Route::get('/{tenant}/edit','TenantController@edit')->name('edit');
            Route::post('/store','TenantController@store')->name('store');
            Route::delete('/{tenant}/destroy','TenantController@destroy')->name('destroy');
            Route::put('/{tenant}/update','TenantController@update')->name('update');
            Route::get('/{tenant}','TenantController@show')->name('show');
            Route::any('/search', 'TenantController@search')->name('search');
        });
    });

Route::prefix('/')->namespace('Site')->group(function(){
    Route::get('','SiteController@index')->name('site.index');
    Route::get('plan/{plan}','SiteController@plan')->name('plan.subscription');
});

Auth::routes();
