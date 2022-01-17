

$( document ).ready(function() {
    loadingInfos();
});

let loadingInfos = async () =>  {
    const ip = await fetch('https://api.ipify.org?format=json')
        .then(resultat => resultat.json())
        .then( json => json.ip);
        
    const city = await fetch(`https://freegeoip.app/json/${ip}`)
        .then(resultat => resultat.json())
        .then(json => json.city)

    const infos = await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&lang=fr&appid=c3a32364dba72b391696cc4dccb0126c&units=metric`)
        .then(resultat => resultat.json())
        .then(json => json)

    displayInfos(infos);
}

let displayInfos = async (json) => {
    let name = json.name;
    let temp = json.main.temp;
    let cond = json.weather[0].main;
    let description = json.weather[0].description;

    $('#ville').text(name);
    $('#temperature').text(Math.round(temp));
    $('#condition').text(description.charAt(0).toUpperCase() + description.slice(1));
    $('.wi').addClass(weatherIcons[cond]);
    $('body').addClass(cond.toLowerCase());
}



const weatherIcons = {
    "Rain" : "wi wi-day-rain",
    "Clouds" : "wi wi-day-cloudy",
    "Clear" : "wi wi-day-sunny",
    "Snow" : "wi wi-day-snowy",
    "Mist" : "wi wi-day-fog",
    "Drizzle" : "wi wi-day-sleet"
}