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
    var newLayer = new ol.layer.Tile({
      source: new ol.source.OSM(),
    });

    map.addLayer(newLayer);

    map
      .getView()
      .setCenter(
        ol.proj.transform(
          [1.727524042379362, 41.2316076388182],
          "EPSG:4326",
          "EPSG:3857"
        )
      );
    map.getView().setZoom(18);
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
