<?php

namespace App\Services\Weather;

interface WeatherServiceInterface
{
    /**
     * Returns the name of the weather service.
     *
     * @return string
     */
    public function getSourceName(): string;

    /**
     * Returns the current weather for the given latitude and longitude from a remote weather service.
     *
     * @param float $latitude
     * @param float $longitude
     * @return WeatherDataDTO
     */
    public function getCurrentWeather(float $latitude, float $longitude): WeatherDataDTO;

    /**
     * Returns current days hourly weather for the given latitude and longitude from a remote weather service.
     *
     * @return array<WeatherDataDTO>
     */
    public function getHourlyWeather(float $latitude, float $longitude): array;
}
