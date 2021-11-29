// const displayWeather = document.getElementById("display-weather");

// const lat = 45.00351934736163,
// const lng = -1.2047443457103568;
// const params = 'windSpeed,waterTemperature';

// fetch(`https://api.stormglass.io/v2/weather/point?lat=${lat}&lng=${lng}&params=${params}`, {
//   headers: {
//     'Authorization': 'dd6eee86-4e93-11ec-86f0-0242ac130002-dd6eeef4-4e93-11ec-86f0-0242ac130002'
//   }
// }).then((response) => response.json()).then((jsonData) => {
//   console.log(jsonData)
// });
const displayWeather = document.querySelector(".weather");
const pannelWeather = document.querySelector(".info-weather");
const closeWeatherInfo = document.querySelector(".close-info-weather");

displayWeather.addEventListener("click", () => {
    pannelWeather.classList.add("info-weather-open");
})

closeWeatherInfo.addEventListener("click", () => {
    pannelWeather.classList.remove("info-weather-open");
})