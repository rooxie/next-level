<?php

namespace App\Services\Weather\OpenMeteo;

enum ForecastType: string
{
    case CURRENT = 'current';
    case HOURLY = 'hourly';

    /**
     * Converts the enum to HTTP request query parameters.
     *
     * @return array<string, string>
     */
    public function getQueryParameters(): array
    {
        switch ($this->value) {
            case self::CURRENT->value:
                return [
                    'current' => 'temperature_2m',
                ];
            case self::HOURLY->value:
                return [
                    'hourly' => 'temperature_2m',
                    'forecast_days' => 1,
                ];
            default:
                return [];
        }
    }
}
