const init = () => {
    document.querySelector("#getWeather").addEventListener("click", zipRequest);
}


const zipRequest = () => {
    let zipCode = document.querySelector("#zip").value;
    getCoordinates(zipCode);
}


const getCoordinates = (zipCode) => {
    let xhr = new XMLHttpRequest();
    let url = "http://api.geonames.org/postalCodeSearchJSON?country=US";
    let method = "get";
    let params = `&postalcode=${zipCode}&username=scrapper_142`;

    xhr.open(method, `${url}${params}`);

    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == 4) {
            //console.log(xhr.responseText);
            let coords = JSON.parse(xhr.responseText);
            //console.log(coords);

            //let codes = coords["postalCodes"];
            //console.log(codes);
            //console.log(typeof(codes));

            getWeather(coords["postalCodes"][0]);
        }
    });
    xhr.send();
}
    

const getWeather = (coords) => {
    let lat = coords["lat"];
    let lng = coords["lng"];
    let city = coords["placeName"];
    
    //console.log(`latitude: ${lat}`);
    //console.log(`longitude: ${lng}`);
    //console.log(`city: ${city}`);

   
    //another request to service for weather here
    let xhr = new XMLHttpRequest();
    let url = "http://api.geonames.org/findNearByWeatherJSON?";
    let method = "get";
    let params = `lat=${lat}&lng=${lng}&username=scrapper_142`;

    xhr.open(method, `${url}${params}`);

    xhr.addEventListener('readystatechange', () => {
        if (xhr.readyState == 4) {
            //console.log(xhr.responseText);
            let weather = JSON.parse(xhr.responseText);
            //console.log(weather);

            let weatherCondtitions = weather["weatherObservation"]; 
            //console.log (typeof(weatherCondtitions));
            //console.log(weatherCondtitions);

            displayWeather(weather["weatherObservation"], city);
        }
    });
    xhr.send();
}


const displayWeather = (weather, city) => {
    //console.log(weather);
    //console.log(city);
    
    let tempC = weather["temperature"];
    //console.log(tempC);
    let tempF = 1.8 * tempC + 32;

    let wind = weather["windSpeed"];
    //console.log(wind);

    let display1 = document.createElement('h1');
    let display2 = document.createElement('h1');
    let display3 = document.createElement('h1');
    display2.textContent = `${tempF} deg. F.`;
    display3.textContent = `${wind} MPH`;

    let cold = document.createElement('img');
    let hot = document.createElement('img');
    let windy = document.createElement('img');
    cold.setAttribute('src', 'cold.png');
    hot.setAttribute('src', 'hot.png');
    windy.setAttribute('src', 'windy.jpg');
    
    display1.setAttribute('id', 'oneTableToRuleThemAll');
    
    display1.appendChild(display2);
    display1.appendChild(display3);

    if (tempF <= 34) {
        display2.appendChild(cold);
    } else if (tempF >= 83) {
        display2.appendChild(hot);
    }

    if (wind >= 15) {
        display3.appendChild(windy);
    }


    //clear appendages if they exist
    let tableInQuestion = document.querySelector('#oneTableToRuleThemAll');
    if (!tableInQuestion) {
        document.body.appendChild(display1);
    } else {
        tableInQuestion.parentNode.replaceChild(display1, tableInQuestion);
    }
    

}


window.addEventListener("load", init);