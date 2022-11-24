<?php

use function App\{
    forecastIntro,
    showCurrentWeather,
    showCurrentWeatherIcon,
    showWeatherForecast
};

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
    <title>Codelex Weather App</title>
</head>
<body>
<section class="hero">
    <nav>
        <h1 class="logo">🌦 Get your weather report!</h1>
        <ul id="nav-list">
            <li><a href="/">Home</a></li>
            <li><a href="/?city=Riga">Riga</a></li>
            <li><a href="/?city=Tallinn">Tallinn</a></li>
            <li><a href="/?city=Vilnius">Vilnius</a></li>
        </ul>
    </nav>
    <div class="main-area">
        <div class="city-input">
            <form action="" method="get">
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
