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
        //
    }
    // app/Providers/RouteServiceProvider.php

public const API_NAMESPACE = 'App\Http\Controllers\Api';

public function map()
{
    $this->mapApiRoutes();  // This includes routes in routes/api.php

    // Other route definitions...
}

protected function mapApiRoutes()
{
    Route::prefix('api')  // This automatically adds /api to the routes
        ->middleware('api')
        ->namespace($this->namespace)
        ->group(base_path('routes/api.php'));
}

}
