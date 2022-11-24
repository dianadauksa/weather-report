<?php

namespace App\Models;

use Cmfcmf\OpenWeatherMap\{Forecast, WeatherForecast};

class ForecastCollection
{
    private WeatherForecast $weatherForecast;

    public function __construct(WeatherForecast $weatherForecast)
    {
        $this->weatherForecast = $weatherForecast;
    }

    private function getForecastData(): WeatherForecast
    {
        return $this->weatherForecast;
    }

    public function getCity(): string
    {
        return $this->getForecastData()->city->name;
    }

    public function getCountry(): string
    {
        return $this->getForecastData()->city->country;
    }

    public function getWeatherForecast(): ?Forecast
    {
        if ($this->getForecastData()->valid()) {
            return $this->getForecastData()->current();
        }
        return null;
    }

    public function canGetForecast(): bool
    {
        return $this->getForecastData()->valid();
    }

    public function nextForecast(): void
    {
        $this->getForecastData()->next();
    }
}