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

$title = "Codelex Weather App";
$city = $_GET['city'] ?? 'Riga';

?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?></title>
    </head>
    <body>
    <h1><?= "🌦 Get your weather report!" ?></h1>
    <h2><a href="/">Home</a>
        <a href="/?city=Riga">Riga</a>
        <a href="/?city=Tallinn">Tallinn</a>
        <a href="/?city=Vilnius">Vilnius</a></h2>
        <form action="index.php" method="get">
            Enter your city <input type="text" name="city"><br>
            <input type="submit" value="See weather">
            <?php
            echo "<br>";
            $currentWeather = fetchCurrentWeather($city);
            if (isset($currentWeather)) {
                $currentWeather = new Weather($currentWeather);
                showCurrentWeather($currentWeather);
            }
            echo "<br>";
            $weatherForecast = fetchWeatherForecast($city);
            if (isset($weatherForecast)) {
                $weatherForecast = new ForecastCollection($weatherForecast);
                showWeatherForecast($weatherForecast);
            }
            echo "<br>";
            ?>
        </form>
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