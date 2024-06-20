<?php

namespace App\Providers;

use App\Events\NewDueEvent;
use App\Listeners\NewDueListener;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
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
        Event::listen(
            NewDueEvent::class,
            NewDueListener::class,
        );

        if(Cache::has('lang')) {
            app()->setLocale(Cache::get('lang'));
        }else {
            app()->setLocale('en');
        }
    }
}
