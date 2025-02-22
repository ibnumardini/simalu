<?php
namespace App\Providers;

use App\Policies\RolePolicy;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.tabler-bootstrap-5');

        // Register the RolePolicy for the Role model.
        // Because the Role model is provided by the spatie/laravel-permission package,
        // we need to register the RolePolicy in the AppServiceProvider.
        Gate::policy(Role::class, RolePolicy::class);
    }
}
