<?php

namespace App\Http\Controllers;

use App\Actions\GetTemperatureReadingsForCity;
use App\Http\Requests\TimezoneAwareRequest;
use App\Models\City;
use Carbon\Carbon;

class CityShowController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(City $city, TimezoneAwareRequest $request)
    {
        $date = Carbon::today($request->getTimezone());

        $temperatureReadings = app()->call(GetTemperatureReadingsForCity::class, [
            'city' => $city,
            'date' => $date,
        ]);

        return view('cities.show', [
            'city' => $city,
            'date' => $date,
            'temperatureReadings' => $temperatureReadings,
        ]);
    }
}
