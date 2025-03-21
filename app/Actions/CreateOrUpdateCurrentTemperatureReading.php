<?php

namespace App\Actions;

use App\Models\City;
use App\Models\TemperatureReading;
use App\Services\Weather\WeatherServiceInterface;

class CreateOrUpdateCurrentTemperatureReading
{
    /**
     * @param City $city
     * @param WeatherServiceInterface $weatherService
     * @return void
     */
    public function __invoke(City $city, WeatherServiceInterface $weatherService): void
    {
        $weatherDataDTO = $weatherService->getCurrentWeather(
            $city->latitude,
            $city->longitude
        );

        TemperatureReading::query()->updateOrCreate(
            [
                'city_id' => $city->id,
                'year' => $weatherDataDTO->time->year,
                'time' => $weatherDataDTO->time->format('Y-m-d H:i:s'),
                'source' => $weatherService->getSourceName(),
            ],
            [
                'city_id' => $city->id,
                'year' => $weatherDataDTO->time->year,
                'time' => $weatherDataDTO->time->format('Y-m-d H:i:s'),
                'source' => $weatherService->getSourceName(),
                'temperature' => $weatherDataDTO->temperature,
            ]
        );
    }
}
