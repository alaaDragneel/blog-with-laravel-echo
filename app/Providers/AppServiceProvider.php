<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('frontend.includes.navbar', function ($view) {
            return $view->with([
                'tags' => Tag::all()
            ]);
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
