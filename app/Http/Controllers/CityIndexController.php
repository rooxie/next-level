<?php

namespace App\Http\Controllers;

use App\Models\City;

class CityIndexController
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('cities.index', [
            'cities' => City::paginate(5),
        ]);
    }
}
