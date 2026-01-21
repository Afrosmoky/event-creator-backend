<?php

namespace App\Providers;

use App\Interfaces\BallroomRepositoryInterface;
use App\Interfaces\SeatRepositoryInterface;
use App\Repositories\BallroomRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\GuestRepository;
use App\Interfaces\GuestRepositoryInterface;
use App\Repositories\ElementRepository;
use App\Repositories\SeatRepository;
use App\Interfaces\ElementRepositoryInterface;
use App\Repositories\ElementConfigRepository;
use App\Interfaces\ElementConfigRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GuestRepositoryInterface::class,GuestRepository::class);
        $this->app->bind(ElementRepositoryInterface::class,ElementRepository::class);
        $this->app->bind(ElementConfigRepositoryInterface::class,ElementConfigRepository::class);
        $this->app->bind(BallroomRepositoryInterface::class,BallroomRepository::class);
        $this->app->bind(SeatRepositoryInterface::class,SeatRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
