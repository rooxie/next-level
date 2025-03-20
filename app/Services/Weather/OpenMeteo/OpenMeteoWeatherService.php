<?php

namespace App\Services\Weather\OpenMeteo;

use App\Services\Weather\WeatherDataDTO;
use App\Services\Weather\WeatherServiceException;
use App\Services\Weather\WeatherServiceInterface;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\Collection;
use Psr\Http\Client\ClientExceptionInterface;

class OpenMeteoWeatherService implements WeatherServiceInterface
{
    public function __construct(
        protected readonly ClientInterface $httpClient,
        protected readonly OpenMeteoConfiguration $configuration,
    ) {
        //
    }

    /**
     * {@inheritDoc}
     */
    public function getSourceName(): string
    {
        return 'openmeteo';
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentWeather(float $latitude, float $longitude): WeatherDataDTO
    {
        $forecast = $this->getForecast($latitude, $longitude, ForecastType::CURRENT);

        return new WeatherDataDTO(
            $forecast['current']['temperature_2m'] ?? null,
                $forecast['timezone'] ?? null,
                $forecast['current']['time'] ?? null
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getHourlyWeather(float $latitude, float $longitude): array
    {
        $forecast = $this->getForecast($latitude, $longitude, ForecastType::HOURLY);

        $time = $forecast['hourly']['time'] ?? [];
        $temperature = $forecast['hourly']['temperature_2m'] ?? [];

        $collection = Collection::times(count($time), function ($index) use ($time, $temperature, $forecast) {
            $i = $index - 1;
            return new WeatherDataDTO(
                $temperature[$i] ?? null,
                $forecast['timezone'] ?? null,
                    $time[$i] ?? null
            );
        });

        if ($collection->isEmpty()) {
            throw new WeatherServiceException('OpenMeteo API returned empty results');
        }

        return $collection->all();
    }

    /**
     * @param float $latitude
     * @param float $longitude
     * @param ForecastType $forecastType
     * @return array
     * @throws WeatherServiceException
     */
    protected function getForecast(float $latitude, float $longitude, ForecastType $forecastType): array
    {
        $options = [
            'timeout' => $this->configuration->timeout,
            'query' => [
                'timezone' => 'auto',
                'latitude' => round($latitude, 2),
                'longitude' => round($longitude, 2),
                ...$forecastType->getQueryParameters()
            ],
        ];

        if ($this->configuration->key) {
            $options['headers']['Authorization'] = sprintf('Bearer %s', $this->configuration->key);
        }

        try {
            $response = $this->httpClient->request('GET', "{$this->configuration->url}/forecast", $options);
        } catch (ClientExceptionInterface $clientException) {
            throw new WeatherServiceException(
                sprintf('OpenMeteo API request failed: %s', $clientException->getMessage()),
                $clientException->getCode(),
                $clientException
            );
        }

        $body = $response->getBody()->getContents();

        if (!json_validate($body)) {
            throw new WeatherServiceException('OpenMeteo API returned invalid JSON');
        }

        $json = json_decode($body, true);

        if (!is_array($json)) {
            throw new WeatherServiceException('OpenMeteo API returned invalid JSON');
        }

        return $json;
    }
}
