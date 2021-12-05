const displayWeather = document.querySelector(".weather");
const pannelWeather = document.querySelector(".info-weather");
const closeWeatherInfo = document.querySelector(".close-info-weather");
const airTemperature = document.querySelector(".info-temp-air");
const waterTemperature = document.querySelector(".info-temp-water");
const swellHeight = document.querySelector(".info-swell");

// API Parameters
const lat = 45.00048697854537;
const lng = -1.2026221659208078;
const params = 'airTemperature,waterTemperature,swellHeight';

displayWeather.addEventListener("click", () => {
    pannelWeather.classList.add("info-weather-open");
    fetch(`https://api.stormglass.io/v2/weather/point?lat=${lat}&lng=${lng}&params=${params}`, {
        headers: {
        'Authorization': 'dd6eee86-4e93-11ec-86f0-0242ac130002-dd6eeef4-4e93-11ec-86f0-0242ac130002'
        }
    }).then((response) => response.json()).then((jsonData) => {
        airTemperature.innerHTML = jsonData.hours[0].airTemperature.dwd + "<span class=\"degree-temp\">°</span>";
        waterTemperature.innerHTML = jsonData.hours[0].waterTemperature.meto + "<span class=\"degree-temp\">°</span>";
        swellHeight.textContent = jsonData.hours[0].swellHeight.dwd + "m";
    });
})

closeWeatherInfo.addEventListener("click", () => {
    pannelWeather.classList.remove("info-weather-open");
})