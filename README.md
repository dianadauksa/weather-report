# weather-report

### PHP 7.4, HTML and CSS code based project for a simple weather reporting program**

 * Project includes the use of [OpenWeatherMap PHP API](https://packagist.org/packages/cmfcmf/openweathermap-php-api) package for accessing the OpenWeatherMap API data with PHP package, in addition to official OpenWeatherMap API documentation, see also [documentation for the package used](https://christianflach.de/OpenWeatherMap-PHP-API/). 

###### PREREQUISITES: Make sure you have PHP(v7.4) and Composer(v2.4) installed on your system. 

#### To run the project:
1. Clone this repository using the following command: `git clone https://github.com/dianadauksa/weather-report`
2. Install the required packages and dependencies: `composer install`
3. Rename the `.env.example` file to `.env`
4. Register on [OpenWeatherMap](https://openweathermap.org) website and generate an API key (for free) -> provide your API key in `.env.example` file as `API_KEY`
5. Run the project from your local server using the command: `php -S localhost:8000` Make sure to run the command from the main directory.
9. Open the generated link in your chosen web browser and start using the website.
 
 #### Project features
 - Enter a city of your interest or use shortcuts to access the weather in the Baltic countries (Estonia, Latvia, Lithuania);
 - Get current weather report in respective city;
 - Get a 24h weather forecast in respective city.


