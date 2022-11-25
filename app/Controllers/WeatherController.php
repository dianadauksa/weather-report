<?php

namespace App\Controllers;

use App\Models\{Weather, ForecastCollection};
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast};
use function App\{apiConnection, fetchCurrentWeather, fetchWeatherForecast};

class WeatherController
{
    private ?OpenWeatherMap $openWeatherMap;

    public function __construct()
    {
        $this->openWeatherMap = apiConnection();
    }

    private function renderView(string $view, array $variables): ?array
    {
        if (count($variables)) {
            extract($variables);
        }
        require_once "views/" . $view . ".php";
        return $variables;
    }

    public function index(): array
    {
        $city = $_GET["city"] ?? "Riga";

        $currentWeather = fetchCurrentWeather($this->openWeatherMap, $city);
        $currentWeather = new Weather($currentWeather);

        $weatherForecast = fetchWeatherForecast($this->openWeatherMap, $city);
        $weatherForecast = new ForecastCollection($weatherForecast);

        return self::renderView('index', compact('currentWeather', 'weatherForecast'));
    }
}