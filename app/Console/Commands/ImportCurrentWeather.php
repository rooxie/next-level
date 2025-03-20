<?php

namespace App\Console\Commands;

use App\Actions\CreateOrUpdateCurrentTemperatureReading;
use App\Console\Commands\Traits\HasMultipleChannelLogMethod;
use App\Console\Commands\Traits\HasWeatherServiceResolver;
use App\Models\City;
use Illuminate\Console\Command;
use Throwable;

class ImportCurrentWeather extends Command
{
    use HasMultipleChannelLogMethod;
    use HasWeatherServiceResolver;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next-level:import-weather-current {service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import current weather for all cities in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $weatherService = $this->getWeatherService();

        $cities = City::all();

        $this->info("Importing current weather for <comment>{$cities->count()}</comment> cities.");

        $progressBar = $this->output->createProgressBar($cities->count());
        $progressBar->start();

        foreach ($cities as $city) {
            try {
                app()->call(CreateOrUpdateCurrentTemperatureReading::class, [
                    'city' => $city,
                    'weatherService' => $weatherService,
                ]);
            } catch (Throwable $e) {
                $this->logError('Failed to update weather report.', [
                    'city_id' => $city->id,
                    'exception' => $e,
                ]);
            }

            $progressBar->advance();
        }

        $progressBar->finish();

        return 0;
    }
}
