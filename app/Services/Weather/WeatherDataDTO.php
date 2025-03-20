<?php

namespace App\Services\Weather;

use Carbon\Carbon;

class WeatherDataDTO
{
    /**
     * @var float
     */
    public readonly float $temperature;

    /**
     * @var Carbon
     */
    public readonly Carbon $time;

    /**
     * @param float $temperature
     * @param string $timezone
     * @param string $time
     */
    public function __construct(float $temperature, string $timezone, string $time)
    {
        $this->temperature = round($temperature, 1);
        $this->time = Carbon::parse($time, $timezone);
    }
}
