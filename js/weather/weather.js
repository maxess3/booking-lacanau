// Elements
const displayWeather = document.querySelector(".weather");
const pannelWeather = document.querySelector(".info-weather");
const closeWeatherInfo = document.querySelector(".close-info-weather");
const airTemperature = document.querySelector(".info-temp-air");
const waterTemperature = document.querySelector(".info-temp-water");
const swellHeight = document.querySelector(".info-swell");

// Refetch API
var date = new Date();
var minutesDateStart = date.getMinutes();
var weatherClicked = false;

// API Parameters
const lat = 45.00048697854537;
const lng = -1.2026221659208078;
const params = 'airTemperature,waterTemperature,swellHeight';

displayWeather.addEventListener("click", () => {
    pannelWeather.classList.add("info-weather-open");
    if(weatherClicked){
        let dateNow = new Date();
        let minutesDateNow = dateNow.getMinutes();
        if(minutesDateNow - minutesDateStart >= 10){
            fetch(`https://api.stormglass.io/v2/weather/point?lat=${lat}&lng=${lng}&params=${params}`, {
            headers: {
            'Authorization': 'dd6eee86-4e93-11ec-86f0-0242ac130002-dd6eeef4-4e93-11ec-86f0-0242ac130002'
            }
            }).then((response) => response.json()).then((jsonData) => {
                airTemperature.classList.add("load-temp-info");
                waterTemperature.classList.add("load-temp-info");
                swellHeight.classList.add("load-temp-info");
                airTemperature.innerHTML = jsonData.hours[0].airTemperature.dwd + "<span class=\"degree-temp\">°</span>";
                waterTemperature.innerHTML = jsonData.hours[0].waterTemperature.meto + "<span class=\"degree-temp\">°</span>";
                swellHeight.textContent = jsonData.hours[0].swellHeight.dwd + "m";
            });
        }
    } else {
        weatherClicked = true;
        fetch(`https://api.stormglass.io/v2/weather/point?lat=${lat}&lng=${lng}&params=${params}`, {
            headers: {
            'Authorization': 'dd6eee86-4e93-11ec-86f0-0242ac130002-dd6eeef4-4e93-11ec-86f0-0242ac130002'
            }
        }).then((response) => response.json()).then((jsonData) => {
            airTemperature.classList.add("load-temp-info");
            waterTemperature.classList.add("load-temp-info");
            swellHeight.classList.add("load-temp-info");
            airTemperature.innerHTML = jsonData.hours[0].airTemperature.dwd + "<span class=\"degree-temp\">°</span>";
            waterTemperature.innerHTML = jsonData.hours[0].waterTemperature.meto + "<span class=\"degree-temp\">°</span>";
            swellHeight.textContent = jsonData.hours[0].swellHeight.dwd + "m";
        });
    }
    
})

closeWeatherInfo.addEventListener("click", () => {
    pannelWeather.classList.remove("info-weather-open");
})