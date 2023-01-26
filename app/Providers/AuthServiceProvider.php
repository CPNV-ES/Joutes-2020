<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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

        Gate::define('isOrg', function ($user) {
            return $user->role->slug ==  'ORG';
        });

    }
}
