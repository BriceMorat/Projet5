
let cityWeather = new Weather();

let city = document.getElementById('cityName');

cityWeather.citiesWeatherRecovery('http://api.weatherstack.com/current?access_key=ffc1e0503a37f54065cab468f9c88590&query=' + city.innerHTML + '');




