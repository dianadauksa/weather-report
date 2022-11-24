<?php

namespace App;

use App\Models\ForecastCollection;
use App\Models\ForecastData;
use App\Models\Weather;
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, Exception as OWMException, WeatherForecast};
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Factory\Guzzle\RequestFactory;

function apiConnection(): ?OpenWeatherMap
{
    $httpRequestFactory = new RequestFactory();
    $httpClient = GuzzleAdapter::createWithConfig([]);
    try {
        return new OpenWeatherMap(API_KEY, $httpClient, $httpRequestFactory);
    } catch (\InvalidArgumentException|\Exception $e) {
        echo "Sorry, weather cannot be retrieved at this time";
    }
    return null;
}

function fetchCurrentWeather(
    OpenWeatherMap $openWeatherMap,
    string         $city,
    string         $units = "metric",
    string         $language = "en"
): ?CurrentWeather
{
    try {
        return $openWeatherMap->getWeather($city, $units, $language);
    } catch (OWMException|\Exception $e) {
        echo "Try a different city";
    }
    return null;
}

function fetchWeatherForecast(
    OpenWeatherMap $openWeatherMap,
    string         $city,
    int            $days = 1,
    string         $units = "metric",
    string         $language = "en"
): ?WeatherForecast
{
    try {
        return $openWeatherMap->getWeatherForecast($city, $units, $language, '', $days);
    } catch (OWMException|\Exception $e) {
        echo "Try a different city";
    }
    return null;
}

function showCurrentWeather(Weather $currentWeather): void
{
    echo "<br>";
    echo "Current weather in {$currentWeather->getCity()}, {$currentWeather->getCountry()}, ";
    echo $currentWeather->getWeatherDescription();
    echo "<br>";
    echo "🌡 Average temperature >> {$currentWeather->getTemperature()}";
    echo "<br>";
    echo "🌪 Wind >> {$currentWeather->getWindDirection()} {$currentWeather->getWindSpeed()}";
    echo "<br>";
    echo "💧 Humidity >> {$currentWeather->getHumidity()}";
    echo "<br>";
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

function showCurrentWeatherIcon(Weather $currentWeather): void
{
    echo "<img class='icon-image' src='" . $currentWeather->getWeatherIconURL() . "'";
    echo "<br>";
}

function forecastIntro(ForecastCollection $weatherForecast): void
{
    echo "Weather forecast for the next 24h in {$weatherForecast->getCity()}, {$weatherForecast->getCountry()}";
}
