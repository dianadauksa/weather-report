<?php

require_once 'vendor/autoload.php';
require_once 'app/functions.php';
require_once 'app/constants.php'; //provide your own API_KEY in constants file

use App\{Weather, ForecastCollection};
use function App\{
    fetchCurrentWeather,
    fetchWeatherForecast,
    showCurrentWeather,
    showWeatherForecast,
    showCurrentWeatherIcon,
    forecastIntro
};

$title = "Codelex Weather App";
$city = $_GET['city'] ?? 'Riga';
$currentWeather = fetchCurrentWeather($city);
if (isset($currentWeather)) {
    $currentWeather = new Weather($currentWeather);
}

$weatherForecast = fetchWeatherForecast($city);
if (isset($weatherForecast)) {
    $weatherForecast = new ForecastCollection($weatherForecast);
}

?>
    <!doctype html>
    <html lang="en">
    <head>
        <link rel="stylesheet" href="styles/styles.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
              rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>
    </head>
    <body>
    <section class="hero">
        <nav>
            <h1 class="logo"><?= "🌦 Get your weather report!" ?></h1>
            <ul id="nav-list">
                <li><a href="/">Home</a></li>
                <li><a href="/?city=Riga">Riga</a></li>
                <li><a href="/?city=Tallinn">Tallinn</a></li>
                <li><a href="/?city=Vilnius">Vilnius</a></li>
            </ul>
        </nav>
        <div class="main-area">
            <div class="city-input">
                <form action="index.php" method="get">
                    <h2>Enter your city</h2><input type="text" name="city"><br>
                    <input type="submit" value="See weather">
                    <br>
                </form>
            </div>
            <div class="home-city">
                <div class="icon">
                    <?php showCurrentWeatherIcon($currentWeather); ?>
                </div>
                <div class="description">
                    <?php showCurrentWeather($currentWeather); ?>
                </div>
            </div>
        </div>
        <div class="forecast-area">
            <h3>
                <?php forecastIntro($weatherForecast); ?>
            </h3>
            <ul id="forecast-list">
                <?php showWeatherForecast($weatherForecast); ?>
            </ul>
        </div>
    </section>
    </body>
    </html>
<?php
/*echo "1. Show current weather" . PHP_EOL;
echo "2. Show weather forecast for next 3 days" . PHP_EOL;
echo "3. Exit" . PHP_EOL;
$selection = intval(readline("Select your choice (1-3): "));

switch ($selection) {
case 1:
$city = readline("Enter city >> ");
$weather = fetchCurrentWeather($city);
if (isset($weather)) {
$weather = new Weather($weather);
showCurrentWeather($weather);
}
break;
case 2:
$city = readline("Enter city >> ");
$weatherForecast = fetchWeatherForecast($city);
if (isset($weatherForecast)) {
$weatherForecast = new ForecastCollection($weatherForecast);
showWeatherForecast($weatherForecast);
}
break;
default:
exit;
}
*/
?>