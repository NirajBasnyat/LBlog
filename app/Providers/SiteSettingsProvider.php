<?php

namespace App\Providers;

use App\Models\Admin\SiteSetting;
use Illuminate\Support\ServiceProvider;
use View;

class SiteSettingsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register() :void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $setting = SiteSetting::first();
            $view->with('setting', $setting);
        });
    }
}
