<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Record' => 'App\Policies\AdminPolicy',
        'App\Product' => 'App\Policies\AdminPolicy',
        'App\RecordsCategory' => 'App\Policies\AdminPolicy',
        'App\ProductsCategory' => 'App\Policies\AdminPolicy',
        'App\Order' => 'App\Policies\AdminPolicy',
        'App\ProductsAttributesName' => 'App\Policies\AdminPolicy',
        'App\ProductsAttributesValue' => 'App\Policies\AdminPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('adminBusiness', 'App\Policies\AdminPolicy@manage');

        Gate::define('userBusiness', function ($user) {
            return $user->role()->first()->id === 2;
        });
    }
}
