<?php

namespace App;

use Cmfcmf\OpenWeatherMap\CurrentWeather;

class Weather
{
    private CurrentWeather $weatherData;

    public function __construct(CurrentWeather $weatherData)
    {
        $this->weatherData = $weatherData;
    }

    private function getWeatherData(): CurrentWeather
    {
        return $this->weatherData;
    }

    public function getCity(): string
    {
        return $this->getWeatherData()->city->name;
    }

    public function getCountry(): string
    {
        return $this->getWeatherData()->city->country;
    }

    public function getTemperature(): string
    {
        return $this->getWeatherData()->temperature->getFormatted();
    }

    public function getWeather(): string
    {
        return $this->getWeatherData()->weather->description;
    }

    public function getHumidity(): string
    {
        return $this->getWeatherData()->humidity->getFormatted();
    }

    public function getWindSpeed(): string
    {
        return $this->getWeatherData()->wind->speed->getFormatted();
    }

    public function getWindDirection(): string
    {
        return $this->getWeatherData()->wind->direction->getUnit();
    }
}