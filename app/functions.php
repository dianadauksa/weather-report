<?php

namespace App;

use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast, Exception as OWMException};
use Http\Factory\Guzzle\RequestFactory;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

function fetchCurrentWeather(
    string $city,
    string $units = "metric",
    string $language = "en"
): ?CurrentWeather
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    $owm = new OpenWeatherMap(API_KEY, $httpClient, $httpRequestFactory);
    try {
        $weather = $owm->getWeather($city, $units, $language);
    } catch (OWMException $e) {
        echo " ";
        return null;
    }
    return $weather;
}

function fetchWeatherForecast(
    string $city,
    int    $days = 2,
    string $units = "metric",
    string $language = "en"
): ?WeatherForecast
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    $owm = new OpenWeatherMap(API_KEY, $httpClient, $httpRequestFactory);
    try {
        $weather = $owm->getWeatherForecast($city, $units, $language, '', $days);
    } catch (OWMException $e) {
        echo " ";
        return null;
    }
    return $weather;
}

function showCurrentWeather(Weather $currentWeather): void
{
    echo "<img src='" . $currentWeather->getWeatherIconURL() . "'";
    echo "<br>";
    echo "<br>";
    echo "Current weather in {$currentWeather->getCity()}, {$currentWeather->getCountry()} >> {$currentWeather->getWeatherDescription()}";
    echo "<br>";
    echo "🌡 Average temperature >> {$currentWeather->getTemperature()}";
    echo "<br>";
    echo "💧 Humidity >> {$currentWeather->getHumidity()}";
    echo "<br>";
    echo "🌪 Wind >> {$currentWeather->getWindDirection()} {$currentWeather->getWindSpeed()}";
    echo "<br>";
}

function showWeatherForecast(ForecastCollection $weatherForecast, int $days = 2): void
{
    echo "Weather forecast for next $days days in {$weatherForecast->getCity()}, {$weatherForecast->getCountry()}";
    while ($weatherForecast->canGetForecast()) {
        $forecast = new ForecastData($weatherForecast->getWeatherForecast());
        echo "<br>";
        echo "<img src='" . $forecast->getWeatherIconURL() . "'";
        echo "<br>";
        echo "{$forecast->getTime()} >> 🌡 {$forecast->getTemperature()} {$forecast->getWeatherDescription()}";
        $weatherForecast->nextForecast();
    }
}
