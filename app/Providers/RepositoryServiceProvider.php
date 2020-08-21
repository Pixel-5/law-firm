<?php

namespace App\Providers;


use App\Repository\CaseRepositoryInterface;
use App\Repository\ClientRepositoryInterface;
use App\Repository\ConveyancingRepositoryInterface;
use App\Repository\Eloquent\CaseRepository;
use App\Repository\Eloquent\ClientRepository;
use App\Repository\Eloquent\ConveyancingRepository;
use App\Repository\Eloquent\FileRepository;
use App\Repository\Eloquent\IndividualFileRepository;
use App\Repository\Eloquent\LitigationRepository;
use App\Repository\Eloquent\ProfileRepository;
use App\Repository\Eloquent\ScheduleRepository;
use App\Repository\EloquentRepositoryInterface;
use App\Repository\FileRepositoryInterface;
use App\Repository\IndividualFileRepositoryInterface;
use App\Repository\LitigationRepositoryInterface;
use App\Repository\ProfileRepositoryInterface;
use App\Repository\ScheduleRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\AbstractBaseRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package App\Providers
 */
class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->bind(IndividualFileRepositoryInterface::class, IndividualFileRepository::class);
        $this->app->bind(ConveyancingRepositoryInterface::class, ConveyancingRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(LitigationRepositoryInterface::class, LitigationRepository::class);
    }

    /**
     *
     */
    public function boot()
    {
        $this->app->singleton('FileRepository', FileRepositoryInterface::class);
        $this->app->singleton('CaseRepository', CaseRepositoryInterface::class);
        $this->app->singleton('UserRepository', UserRepositoryInterface::class);
        $this->app->singleton('ScheduleRepository', ScheduleRepositoryInterface::class);
        $this->app->singleton('ProfileRepository', ProfileRepositoryInterface::class);
        $this->app->singleton('IndividualFileRepository', IndividualFileRepositoryInterface::class);
        $this->app->singleton('ConveyancingRepository', ConveyancingRepositoryInterface::class);
        $this->app->singleton('ClientRepository', ClientRepositoryInterface::class);
        $this->app->singleton('LitigationRepository', LitigationRepositoryInterface::class);
    }
}
