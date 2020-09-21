<?php

namespace App\Providers;

use App\Models\{
    Category, Client, Plan,Product, Role, Table, Tenant
};

use App\Observers\{
    CategoryObserver, ClientObserver, PlanObserver,ProductObserver, TableObserver, TenantObserver
};


use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Plan::observe(PlanObserver::class);
        Product::observe(ProductObserver::class);
        Tenant::observe(TenantObserver::class);
        Client::observe(ClientObserver::class);
        Table::observe(TableObserver::class);
        Role::observe(Role::class);
        
    }
}
