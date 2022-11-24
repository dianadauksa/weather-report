<?php

namespace App\Models;

use Cmfcmf\OpenWeatherMap\CurrentWeather;

class Weather
{
    private CurrentWeather $currentWeather;

    public function __construct(CurrentWeather $currentWeather)
    {
        $this->currentWeather = $currentWeather;
    }

    private function getWeather(): CurrentWeather
    {
        return $this->currentWeather;
    }

    public function getCity(): string
    {
        return $this->getWeather()->city->name;
    }

    public function getCountry(): string
    {
        return $this->getWeather()->city->country;
    }

    public function getTemperature(): string
    {
        return $this->getWeather()->temperature->getFormatted();
    }

    public function getWeatherDescription(): string
    {
        return $this->getWeather()->weather->description;
    }

    public function getHumidity(): string
    {
        return $this->getWeather()->humidity->getFormatted();
    }

    public function getWindSpeed(): string
    {
        return $this->getWeather()->wind->speed->getFormatted();
    }

    public function getWindDirection(): string
    {
        return $this->getWeather()->wind->direction->getUnit();
    }

    public function getWeatherIconURL(): ?string
    {
        return $this->getWeather()->weather->getIconUrl();
    }
}