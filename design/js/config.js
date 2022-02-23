// <!---------- MAPBOX ---------->

// /* pk.eyJ1IjoidmFsZW50aXBwIiwiYSI6ImNremg0cjdwbTJucHgybm8xazR6enQ3ZXQifQ._BJ1QyBTRntc61LN6G_Kfw */

// mapboxgl.accessToken='pk.eyJ1IjoidmFsZW50aXBwIiwiYSI6ImNremg0cjdwbTJucHgybm8xazR6enQ3ZXQifQ._BJ1QyBTRntc61LN6G_Kfw'

// let map = new mapboxgl.Map({

//     container:'map',
//     style: 'mapbox://styles/mapbox/streets-v10',
//     center:[1.728508, 41.231164],
//     zoom: 18

// })


// MAPA
var map = L.map('mapa').setView([41.231322284217, 1.7281074555046259], 18);
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    attribution: '<a href="https://www.instagram.com/pedreleee23/" target="_blank">@pedrele23©</a>',
    maxZoom: 20,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1
}).addTo(map);

// 1 MARCADOR
var marker = L.circle([41.23118511665772, 1.7280967266692684], {radius: 30, color: 'black'}).bindPopup('INSTITUT').addTo(map);
marker.openPopup();

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(mostrarPosicio);
} else { 
    alert("No hemos podido coger tu ubicación.");
}


// 2 MARCADOR
function mostrarPosicio(position) {
    
    var marker2 = L.circle([position.coords.latitude, position.coords.longitude], {radius: 30, color: 'red'}).bindPopup('ESTÀS PER AQUESTA ZONA').addTo(map);
    marker2.openPopup();

    Mousetrap.bind('ctrl+shift+k', function(e) {
        alert(position.coords.latitude + " " + position.coords.longitude)
    });

    // RUTA
    L.Routing.control({
    waypoints: [
        L.latLng(41.23118511665772, 1.7280967266692684),
        L.latLng(position.coords.latitude, position.coords.longitude)
    ]}).addTo(map);


}