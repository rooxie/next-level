<?php

namespace App\Providers;

use App\Services\Weather\OpenMeteo\OpenMeteoConfiguration;
use App\Services\Weather\OpenMeteo\OpenMeteoWeatherService;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->when(OpenMeteoWeatherService::class)
            ->needs(GuzzleClientInterface::class)
            ->give(GuzzleClient::class);

        $this->app->singleton(OpenMeteoConfiguration::class, function () {
            return new OpenMeteoConfiguration(
                key: config('services.openmeteo.key'),
                url: config('services.openmeteo.url'),
                timeout: config('services.openmeteo.timeout'),
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
