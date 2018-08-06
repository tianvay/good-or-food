<?php

namespace App\Providers;

use App\Monster;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('partials.sidebar', function ($view) {
            $view
                ->with('archives', Post::archives())
                ->with('monster', Monster::monsterOfTheDay())
            ;
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
