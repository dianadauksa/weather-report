<?php

namespace App;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast, Exception as OWMException};
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

function fetchCurrentWeather(string $city, string $units = "metric", string $language = "en"): ?CurrentWeather
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    $owm = new OpenWeatherMap(API_KEY, $httpClient, $httpRequestFactory);
    try {
        $weather = $owm->getWeather($city, $units, $language);
    } catch (OWMException $e) {
        echo "Weather report not available! :(" . PHP_EOL;
        return null;
    }
    return $weather;
}

function fetchWeatherForecast(string $city, int $days = 3, string $units = "metric", string $language = "en"): ?WeatherForecast
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    $owm = new OpenWeatherMap(API_KEY, $httpClient, $httpRequestFactory);
    try {
        $weather = $owm->getWeatherForecast($city, $units, $language, '', $days);
    } catch (OWMException $e) {
        echo "Weather forecast not available! :(" . PHP_EOL;
        return null;
    }
    return $weather;
}

function showCurrentWeather(Weather $weatherData): void
{
    echo PHP_EOL;
    echo "Current weather in {$weatherData->getCity()}, {$weatherData->getCountry()}" . PHP_EOL;
    echo "🌡 Average temperature >> {$weatherData->getTemperature()}" . PHP_EOL;
    echo "🌥 Weather conditions >> {$weatherData->getWeather()}". PHP_EOL;
    echo "💧 Humidity >> {$weatherData->getHumidity()}" . PHP_EOL;
    echo "🌪 Wind >> {$weatherData->getWindDirection()} {$weatherData->getWindSpeed()}" . PHP_EOL;
}

function showWeatherForecast(ForecastCollection $weatherData, int $days = 3): void
{
    echo PHP_EOL;
    echo "Weather forecast for the next $days days in {$weatherData->getCity()}, {$weatherData->getCountry()}" . PHP_EOL;
    while ($weatherData->canGetForecast()) {
        $forecast = new ForecastData($weatherData->getWeatherForecast());
        echo "{$forecast->getTime()} 🌡 {$forecast->getTemperature()} 🌥 {$forecast->getWeather()}" . PHP_EOL;
        $weatherData->nextForecast();
    }
}
