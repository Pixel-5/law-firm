<?php

namespace App\Providers;

use App\Facade\UserRepository;
use App\Http\View\Composers\CaseComposer;
use App\Http\View\Composers\FileComposer;
use App\Http\View\Composers\UserComposer;
use App\Mixins\StrMixins;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Telescope\TelescopeServiceProvider;
use ReflectionException;
use Spatie\Activitylog\Models\Activity;

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
        View::composer(['client.*','admin.*','lawyer.*',], FileComposer::class);
        View::composer(['lawyer.*', 'admin.*','client.cases.*'], CaseComposer::class);
        View::composer(['lawyer.*', 'admin.*','layouts.top-nav-bar'], UserComposer::class);
        View::composer('partials.lawyers',function ($view){
            return $view->with('lawyers',UserRepository::getLawyersOnly());
        });
        View::composer('admin.activity_log',function ($view){
            $usersActivityLog = Activity::where('log_name','user');
            $filesActivityLog = Activity::where('log_name','file');
            $casesActivityLog = Activity::where('log_name','case');
            $schedulesActivityLog = Activity::where('log_name','schedule');

            return $view->with([
                'usersActivityLog' => $usersActivityLog,
                'filesActivityLog' => $filesActivityLog,
                'casesActivityLog' => $casesActivityLog,
                'schedulesActivityLog' => $schedulesActivityLog,
            ]);
        });

        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
