<?php

namespace App\Providers;

use App\Http\View\Composers\FileComposer;
use App\Mixins\StrMixins;
use App\Repositories\FileRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //custom string mixins
        Str::mixin(new StrMixins());

        Schema::defaultStringLength(191);

        //singleton of file repository
        $this->app->singleton('FileRepository',function ($app){
            return new FileRepository();
        });

        //singleton of case repository
        $this->app->singleton('CaseRepository',function ($app){
            return new CaseRepository();
        });

        //custom view composers
        View::composer('admin.client.*', FileComposer::class);
    }
}
