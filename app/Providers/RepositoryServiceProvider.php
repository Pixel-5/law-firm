<?php
namespace App\Providers;


use App\File;
use App\FileCase;
use App\Repository\CaseRepositoryInterface;
use App\Repository\Eloquent\CaseRepository;
use App\Repository\Eloquent\FileRepository;
use App\Repository\Eloquent\ScheduleRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\FileRepositoryInterface;
use App\Repository\ScheduleRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\AbstractBaseRepository;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, AbstractBaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(CaseRepositoryInterface::class, CaseRepository::class);
        $this->app->bind(ScheduleRepositoryInterface::class, ScheduleRepository::class);
    }

    /**
     *
     */
    public function boot()
    {
        $this->app->singleton('FileRepository',FileRepositoryInterface::class);
        $this->app->singleton('CaseRepository',CaseRepositoryInterface::class);
        $this->app->singleton('UserRepository',UserRepositoryInterface::class);
        $this->app->singleton('ScheduleRepository',ScheduleRepositoryInterface::class);
    }

    public function provides()
    {
        return [
            FileRepository::class,
            CaseRepository::class,
            UserRepository::class,
            ScheduleRepository::class
            ];
    }

}
