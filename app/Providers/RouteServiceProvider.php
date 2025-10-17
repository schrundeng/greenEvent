<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use App\Models\Event;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });

        Route::bind('event', function ($value) {
            if (is_numeric($value)) {
                return Event::where('id', $value)
                    ->orWhere('slug', $value)
                    ->firstOrFail();
            }
            return Event::where('slug', $value)->firstOrFail();
        });
    }
}
