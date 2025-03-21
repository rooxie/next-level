<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public const array CITIES = [
        //
        // Spain
        ['name' => 'Palma', 'country_code' => 'ES', 'latitude' => '39.5696', 'longitude' => '2.6502', 'timezone' => 'Europe/Madrid'],
        ['name' => 'Santa Cruz de Tenerife', 'country_code' => 'ES', 'latitude' => '28.4636', 'longitude' => '-16.2518', 'timezone' => 'Atlantic/Canary'],
        //
        // Germany
        ['name' => 'Berlin', 'country_code' => 'DE', 'latitude' => '52.5200', 'longitude' => '13.4050', 'timezone' => 'Europe/Berlin'],
        ['name' => 'Munich', 'country_code' => 'DE', 'latitude' => '48.1351', 'longitude' => '11.5820', 'timezone' => 'Europe/Berlin'],
        //
        // United Kingdom
        ['name' => 'London', 'country_code' => 'GB', 'latitude' => '51.5074', 'longitude' => '-0.1278', 'timezone' => 'Europe/London'],
        ['name' => 'Manchester', 'country_code' => 'GB', 'latitude' => '53.4830', 'longitude' => '-2.2000', 'timezone' => 'Europe/London'],
        //
        // France
        ['name' => 'Paris', 'country_code' => 'FR', 'latitude' => '48.8566', 'longitude' => '2.3522', 'timezone' => 'Europe/Paris'],
        ['name' => 'Marseille', 'country_code' => 'FR', 'latitude' => '43.2965', 'longitude' => '5.3698', 'timezone' => 'Europe/Paris'],
        //
        // Finland
        ['name' => 'Helsinki', 'country_code' => 'FI', 'latitude' => '60.1695', 'longitude' => '24.9354', 'timezone' => 'Europe/Helsinki'],
        ['name' => 'Tampere', 'country_code' => 'FI', 'latitude' => '61.4978', 'longitude' => '23.7610', 'timezone' => 'Europe/Helsinki'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::CITIES as $city) {
            City::create($city);
        }
    }
}
