<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Letter;
use App\Observers\LetterObserver;
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
	   Letter::observe(LetterObserver::class);
    }
}
