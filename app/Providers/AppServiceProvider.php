<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Constants\CommonConstants;
use App\Events\MyEvent;
use Illuminate\Support\Facades\Event;

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
        view()->share('STATUS_NONE', (string)CommonConstants::STATUS_NONE);
        view()->share('STATUS_RECEIVED', (string)CommonConstants::STATUS_RECEIVED);
        view()->share('STATUS_IN_PROGRESS', (string)CommonConstants::STATUS_IN_PROGRESS);
        view()->share('STATUS_COMPLETED', (string)CommonConstants::STATUS_COMPLETED);
        Event::listen(MyEvent::class, function ($event) {
            //dd($event);
        });
    }
}
