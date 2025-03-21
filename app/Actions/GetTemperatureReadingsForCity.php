<?php

namespace App\Actions;

use App\Models\City;
use App\Models\TemperatureReading;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class GetTemperatureReadingsForCity
{
    /**
     * @param City $city
     * @param Carbon $date
     * @return Collection<TemperatureReading>|TemperatureReading[]
     */
    public function __invoke(City $city, Carbon $date): Collection
    {
        $temperatureReadings = TemperatureReading::query()->where('city_id', $city->id)
            ->whereDate('time', '=', $date)
            ->get();

        return $temperatureReadings;
    }
}
