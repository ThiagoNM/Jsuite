
if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(mostrarPosition);
} else {
  alert("Please");
}

key.bind();

function mostrarPosition(position) {
  var latitude = position.coords.latitude;
  var longitude = position.coords.longitude;

  key('ctrl+alt+g','issues', function () {
    alert(
      "Esta son tus coordenadas: " +
        position.coords.latitude +
        " " +
        position.coords.longitude
    );
    return false;
  });

  key('ctrl+alt+c', 'issues', function () {
    map.setView(new L.LatLng(41.231322284217, 1.7281074555046259), 18);
  });

  key('i', function(){
    key.setScope('issues');
    alert('activando atajos de teclado');
  });

  key('o', function(){
    key.setScope();
    alert('desactivando atajos de teclado');
  });
}
