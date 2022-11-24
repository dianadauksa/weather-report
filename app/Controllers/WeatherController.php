<?php

namespace App\Controllers;

use App\Models\{Weather, ForecastCollection};
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast};
use function App\{apiConnection, fetchCurrentWeather, fetchWeatherForecast};

class WeatherController
{
    private ?OpenWeatherMap $openWeatherMap;
    private ?CurrentWeather $weatherData;
    private ?WeatherForecast $forecastData;
    private Weather $currentWeather;
    private ForecastCollection $weatherForecast;

    public function __construct()
    {
        $this->openWeatherMap = apiConnection();
        $this->setWeatherData();
        $this->setForecastData();
        $this->setCurrentWeather();
        $this->setWeatherForecast();
    }

    private function setWeatherData(): void
    {
        $city = $_GET["city"] ?? "Riga";
        $this->weatherData = fetchCurrentWeather($this->openWeatherMap, $city);
    }

    private function setForecastData(): void
    {
        $city = $_GET["city"] ?? "Riga";
        $this->forecastData = fetchWeatherForecast($this->openWeatherMap, $city);
    }

    private function setCurrentWeather(): void
    {
        $this->currentWeather = new Weather($this->weatherData);
    }

    private function setWeatherForecast(): void
    {
        $this->weatherForecast = new ForecastCollection($this->forecastData);
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
        $currentWeather = $this->currentWeather;
        $weatherForecast = $this->weatherForecast;
        return self::renderView('index', compact('currentWeather', 'weatherForecast'));
    }
}