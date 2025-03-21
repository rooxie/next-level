# Next Level Test Project


## WARNING
The project requires PHP 8.4, however I didn't require PHP 8.4 explicitly in `composer.json` because in order to start Laravel Sail (Docker wrapper), you need to install the dependencies first, and I assume that PHP version on your local machine is not `8.4` yet.

## Installation
1. Install Composer dependencies.
```bash
composer update
```

2. Install NPM dependencies and compile assets.
```bash
npm install
npm run build
```

3. Build and run Laravel Sail environment.
```bash
./vendor/bin/sail build --no-cache
./vendor/bin/sail up -d
```

4. Run the migrations with the `--seed` flag to seed the database with city records.
```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

## Usage
### Web UI
Open the browser and navigate to the application URL.

- Here you will see a paginated table with the list of cities and a button that navigates to the city show page.

- On the city show page, you will see the city details and a line chart with the temperature forecast for today **(your browser timezone is used)**.

### CLI
#### Scheduler
You can trigger the scheduled hourly report instantly by running the following command.
```bash
./vendor/bin/sail artisan schedule:test
# ┌ Which command would you like to run? ──────────────────────────────────────────┐
# │ › ● '/usr/bin/php8.4' 'artisan' next-level:import-weather-hourly 'openmeteo'   │
# └────────────────────────────────────────────────────────────────────────────────┘
```

#### Manually import hourly temperature for all cities
This command will import the hourly temperature for all cities from OpenMeteo API based on current real time in that city.
> NOTE: For example, if current time is 00:30 and the server is located in Germany, than the hourly forecast for German cities will be imported for current day, but the forecasts for UK and USA will be imported for the previous day.
```bash
./vendor/bin/sail artisan next-level:import-weather-hourly openmeteo
```

#### Manually import current temperature for all cities
This command wasn't a part of the original requirements, but I've added it for the sake of demonstation of flexibility of the weather service implementation.

This command will import the current temperature for all cities from OpenMeteo API based on current real time in that city.
> NOTE: Just like with previous command, the real time of the queried location is used.
```bash
./vendor/bin/sail artisan next-level:import-weather-current openmeteo
```
