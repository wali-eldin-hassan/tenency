<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        view()->composer(['layouts.navbar', 'components.category-tabs', 'tenants.store.home'], function ($view) {
            $view->categories = Cache::remember('categories', now()->addHour(), function () {
                return Category::all();
            });
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
