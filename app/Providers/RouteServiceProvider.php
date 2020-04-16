<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const ADMIN =  'admin.dashboard';
    public const LAWYER = 'lawyer.dashboard';
    public const SUPER =  'super.dashboard';
    public const HOME =  '/';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    public static function redirectPath()
    {
        if (auth()->user()->roles->count() < 0){

            auth()->logout();
            abort_if(Gate::denies('system_access'),
                Response::HTTP_UNAUTHORIZED);
        }
        $role = auth()->user()->roles->first();

        switch ($role->title){
            case self::ADMIN or self::SUPER:
                return route(self::ADMIN);

            case self::LAWYER:
                return route(self::LAWYER);

            default:
                auth()->logout();
                return self::HOME;
        }
    }
}
