<?php

namespace App\Providers;

use App\Facade\UserRepository;
use App\Http\View\Composers\CaseComposer;
use App\Http\View\Composers\FileComposer;
use App\Mixins\StrMixins;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Telescope\TelescopeServiceProvider;
use ReflectionException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws ReflectionException
     */
    public function boot(): void
    {
        //custom string mixins
        Str::mixin(new StrMixins());
        Schema::defaultStringLength(191);

        //custom view composers
        View::composer(['client.*','admin.*'], FileComposer::class);
        View::composer(['lawyer.*', 'admin.*',], CaseComposer::class);

        View::composer('partials.lawyers',function ($view){
            return $view->with('lawyers',UserRepository::getLawyersOnly());
        });
    }
}
