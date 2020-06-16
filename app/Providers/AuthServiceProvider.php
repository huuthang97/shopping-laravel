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

        // Gate::define('role_view', function ($user) {
        //     return $user->checkPermission('role_view');
        // });

        Gate::define('role_view', 'App\Policies\RolePolicy@view');
        Gate::define('role_add', 'App\Policies\RolePolicy@create');
        Gate::define('role_edit', 'App\Policies\RolePolicy@update');
        Gate::define('role_delete', 'App\Policies\RolePolicy@delete');
    }
}
