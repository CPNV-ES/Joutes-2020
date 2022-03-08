<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isGest', function ($user) {
            return $user->role->slug ==  'GEST';
        });

        Gate::define('isPart', function ($user) {
            return $user->role->slug ==  'PART';
        });

        Gate::define('isAdmin', function ($user) {
            return $user->role->slug ==  'ADMIN';
        });
    }
}
