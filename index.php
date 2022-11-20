<?php

require_once 'vendor/autoload.php';
require_once 'app/functions.php';
require_once 'app/constants.php'; //provide your own API_KEY in constants file

use App\{Weather, ForecastCollection};
use function App\{
    fetchCurrentWeather,
    fetchWeatherForecast,
    showCurrentWeather,
    showWeatherForecast
};

echo "Get weather report!" . PHP_EOL;
echo "1. Show current weather" . PHP_EOL;
echo "2. Show weather forecast for next 3 days" . PHP_EOL;
echo "3. Exit" . PHP_EOL;
$selection = intval(readline("Input number (1-3): "));

switch ($selection) {
    case 1:
        $city = readline("Enter city >> ");
        $weatherData = fetchCurrentWeather($city);
        if (isset($weatherData)) {
            $weatherData = new Weather($weatherData);
            showCurrentWeather($weatherData);
        }
        break;
    case 2:
        $city = readline("Enter city >> ");
        $weatherForecastData = fetchWeatherForecast($city);
        if (isset($weatherForecastData)) {
            $weatherForecastData = new ForecastCollection($weatherForecastData);
            showWeatherForecast($weatherForecastData);
        }
        break;
    default:
        exit;
}