<?php

namespace App\Actions;

use App\Models\City;
use App\Models\TemperatureReading;
use App\Services\Weather\WeatherServiceInterface;
use Illuminate\Support\Facades\DB;

class CreateOrUpdateHourlyTemperatureReadings
{
    /**
     * @param City $city
     * @param WeatherServiceInterface $weatherService
     * @return void
     */
    public function __invoke(City $city, WeatherServiceInterface $weatherService): void
    {
        $weatherDataDTOs = $weatherService->getHourlyWeather(
            $city->latitude,
            $city->longitude
        );

        DB::transaction(function () use ($city, $weatherService, $weatherDataDTOs) {
            foreach ($weatherDataDTOs as $weatherDataDTO) {
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
        });
    }
}
