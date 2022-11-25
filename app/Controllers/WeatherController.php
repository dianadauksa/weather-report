<?php

namespace App\Controllers;

use App\Models\{Weather, ForecastCollection};
use Cmfcmf\OpenWeatherMap;
use Cmfcmf\OpenWeatherMap\{CurrentWeather, WeatherForecast};
use function App\{apiConnection, fetchCurrentWeather, fetchWeatherForecast};

class WeatherController extends BaseController
{
    private ?OpenWeatherMap $openWeatherMap;

    public function __construct()
    {
        $this->openWeatherMap = apiConnection();
    }

    public function index(): array
    {
        $city = $_GET["city"] ?? "Riga";

        $currentWeather = fetchCurrentWeather($this->openWeatherMap, $city);
        $currentWeather = new Weather($currentWeather);

        $weatherForecast = fetchWeatherForecast($this->openWeatherMap, $city);
        $weatherForecast = new ForecastCollection($weatherForecast);

        return $this->render('index', compact('currentWeather', 'weatherForecast'));
    }
}
