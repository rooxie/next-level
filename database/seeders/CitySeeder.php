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
        //
        // Japan
        ['name' => 'Tokyo', 'country_code' => 'JP', 'latitude' => '35.6895', 'longitude' => '139.6917', 'timezone' => 'Asia/Tokyo'],
        //
        // USA
        ['name' => 'New York', 'country_code' => 'US', 'latitude' => '40.7128', 'longitude' => '-74.0060', 'timezone' => 'America/New_York'],
        ['name' => 'Los Angeles', 'country_code' => 'US', 'latitude' => '34.0522', 'longitude' => '-118.2437', 'timezone' => 'America/Los_Angeles'],
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
