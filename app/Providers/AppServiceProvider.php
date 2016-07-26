<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SpotifyProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'spotify',
            function ($app) use ($socialite) {
                $config = $app['config']['services.spotify'];
                return $socialite->buildProvider(SpotifyProvider::class, $config);
            }
        );
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
