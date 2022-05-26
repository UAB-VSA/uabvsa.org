<?php

namespace App\Providers;

use App\Enums\DiscordRole;
use App\Models\User;
use App\Nova\Dashboards\Main;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot ()
    {
        parent::boot();
    }

    /**
     * Register the Nova routes.
     * @return void
     */
    protected function routes ()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register any application services.
     * @return void
     */
    public function register ()
    {
        //
    }

    /**
     * Register the Nova gate.
     * This gate determines who can access Nova in non-local environments.
     * @return void
     */
    protected function gate (): void
    {
        Gate::define('viewNova', fn(User $user) => $user->isAdmin());
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     * @return array
     */
    protected function dashboards ()
    {
        return [
            new Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     * @return array
     */
    public function tools ()
    {
        return [];
    }
}
