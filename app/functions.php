<?php

namespace App;

use App\Models\ForecastCollection;
use App\Models\ForecastData;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast};
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Factory\Guzzle\RequestFactory;

function apiConnection(): ?OpenWeatherMap
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    $api_key = $_ENV['API_KEY'];
    return new OpenWeatherMap($api_key, $httpClient, $httpRequestFactory);
}

function fetchCurrentWeather(
    OpenWeatherMap $openWeatherMap,
    string         $city,
    string         $units = "metric",
    string         $language = "en"
): ?CurrentWeather
{
        return $openWeatherMap->getWeather($city, $units, $language);
}

function fetchWeatherForecast(
    OpenWeatherMap $openWeatherMap,
    string         $city,
    int            $days = 1,
    string         $units = "metric",
    string         $language = "en"
): ?WeatherForecast
{
        return $openWeatherMap->getWeatherForecast($city, $units, $language, '', $days);
}

function showWeatherForecast(ForecastCollection $weatherForecast): void
{
    while ($weatherForecast->canGetForecast()) {
        $forecast = new ForecastData($weatherForecast->getWeatherForecast());
        echo "<li>";
        echo "<br>";
        echo "<img src='" . $forecast->getWeatherIconURL() . "'";
        echo "<br>";
        echo "<br>";
        echo $forecast->getTime();
        echo "<br>";
        echo "🌡 {$forecast->getTemperature()}";
        echo "<br>";
        echo "{$forecast->getWeatherDescription()}";
        echo "</li>";
        $weatherForecast->nextForecast();
    }
}