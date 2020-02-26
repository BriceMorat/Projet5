class Weather {

//cities weather recovery
    citiesWeatherRecovery(source) {
       
        ajaxGet(source, response => {
            this.cityWeatherList = JSON.parse(response);

            this.localHour = document.getElementById('localHour');
            this.temperature = document.getElementById('temperature');
            this.weatherIcon = document.getElementById('weatherIcon');

            this.localTime = this.cityWeatherList.location.localtime_epoch;
            this.date = new Date(this.localTime*1000 - 2760000);
            this.hours = this.date.getHours();
            this.minutes = this.date.getMinutes();
        
            this.localHour.innerHTML = this.hours + ' h ' + this.minutes + ' min';
            this.temperature.innerHTML = this.cityWeatherList.current.temperature;

            this.temperature.textContent += " °C";

            for (let i = 0; i < this.cityWeatherList.current.weather_icons.length; i++) {
                this.weatherIcon.src = this.cityWeatherList.current.weather_icons[i];
            }
        })
    } 
}


