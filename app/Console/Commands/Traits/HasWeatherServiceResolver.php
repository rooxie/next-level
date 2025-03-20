<?php

namespace App\Console\Commands\Traits;

use App\Services\Weather\OpenMeteo\OpenMeteoWeatherService;
use App\Services\Weather\WeatherServiceInterface;
use Illuminate\Contracts\Container\BindingResolutionException;

trait HasWeatherServiceResolver
{
    /**
     * Returns available weather services as array method for easier overriding and extending.
     *
     * @return array<string, string>
     */
    protected function getWeatherServices(): array
    {
        return [
            'openmeteo' => OpenMeteoWeatherService::class,
        ];
    }

    /**
     * Throws an exception if weather service implementation not found.
     *
     * @return WeatherServiceInterface
     * @throws BindingResolutionException
     */
    final protected function getWeatherService(): WeatherServiceInterface
    {
        return app()->make(
            $this->getWeatherServices()[strtolower(trim($this->argument('service')))] ?? null
        );
    }
}
