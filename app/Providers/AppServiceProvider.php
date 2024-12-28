<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        \Blade::directive('activeClass', function ($route) {
            return "<?php echo request()->routeIs($route) ? 'active' : ''; ?>";
        });
    }
}
