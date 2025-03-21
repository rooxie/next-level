<?php

use App\Console\Commands\ImportHourlyWeather;
use Illuminate\Support\Facades\Schedule;

Schedule::command(ImportHourlyWeather::class, ['openmeteo'])->hourly();
