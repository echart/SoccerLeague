var map;
var infobox;
var clubMarker=null;
var markers=[];
var image = {
  url: 'assets/img/icons/football.png',
// This marker is 20 pixels wide by 32 pixels high.
  size: new google.maps.Size(32,32),
  // The origin for this image is (0, 0).
  origin: new google.maps.Point(0, 0),
  // The anchor for this image is the base of the flagpole at (0, 24).
  anchor: new google.maps.Point(0, 32)
};
function initialize() {
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(-16.00357573, -47.85644531),
    styles: [
      {
        featureType: 'all',
        stylers: [
          { saturation: -80 }
        ]
      },{
        featureType: 'road.arterial',
        elementType: 'geometry',
        stylers: [
          { hue: '#00ffee' },
          { saturation: 50 }
        ]
      },{
        featureType: 'poi.business',
        elementType: 'labels',
        stylers: [
          { visibility: 'off' }
        ]
      }
    ]
  };

  map = new google.maps.Map(document.getElementById('map'),mapOptions);
  var infoWindow = new google.maps.InfoWindow({map: map});
  var geocoder = new google.maps.Geocoder;
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      //loadAllMarkers();
      geocodeLatLng(geocoder,pos);
      infoWindow.setPosition(pos);
      infoWindow.setContent('Sua localização atual é esta! A localização de outros clubes é indicada através de uma bola de futebol! Você pode mover o seu clube para qualquer lugar do mapa, mas tenha sabedoria ao escolher. <h3>O país escolhido representa a liga nacional pelo qual seu clube jogará!</h3> E você não terá possibilidade de mudança. Além disso, a escolha de localidade possibita maior interação entre os usuários, campeonatos regionais e etc...');
      addMarker(pos,true);
      map.setCenter(pos);
    }, function() {
      var pos = {
        lat: -31.769234899999994,
        lng: -52.3391811
      };
      //loadAllMarkers();
      geocodeLatLng(geocoder,pos);
      infoWindow.setPosition(pos);
      infoWindow.setContent('Sua localização atual é esta! A localização de outros clubes é indicada através de uma bola de futebol! Você pode mover o seu clube para qualquer lugar do mapa, mas tenha sabedoria ao escolher. <h3>O país escolhido representa a liga nacional pelo qual seu clube jogará!</h3> E você não terá possibilidade de mudança. Além disso, a escolha de localidade possibita maior interação entre os usuários, campeonatos regionais e etc...');
      addMarker(pos,true);
      map.setCenter(pos);
    });
  }
  map.addListener('click', function(event) {
    geocodeLatLng(geocoder,event.latLng);
    addMarker(event.latLng, false);
  });
  infobox = new InfoBox({
       content: document.getElementById("infowindow"),
       disableAutoPan: false,
       maxWidth: 310,
       pixelOffset: new google.maps.Size(-140, 0),
       zIndex:10,
      closeBoxMargin: "12px 4px 2px 2px",
  });
}
/*
RETURNS COUNTRY BASED ON THE USER marker
*/
function geocodeLatLng(geocoder, pos) {
  var latlng =pos;
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        if(results[results.length-1].address_components[0].short_name!='BR'){
          newAlert('danger','Por enquanto, contamos apenas com a possibilidade de escolha dentro do Brasil',10000,'top');
        }
        $("input[name='country']").val(results[results.length-1].address_components[0].short_name);
        $("input[name='lat']").val(pos.lat);
        $("input[name='lng']").val(pos.lng);
      }
    }
  });
}
/*
ADDED A USER MARKER
*/
function addMarker(location,flag) {
  var image = {
    url: 'assets/img/icons/marker.png',
    // This marker is 20 pixels wide by 32 pixels high.
    size: new google.maps.Size(32,32),
    // The origin for this image is (0, 0).
    origin: new google.maps.Point(0, 0),
    // The anchor for this image is the base of the flagpole at (0, 24).
    anchor: new google.maps.Point(16, 32)
  };
  var marker = new google.maps.Marker({
    position: location,
    map: map,
    icon: image
  });

  if(clubMarker!=null){
    clubMarker.setMap(null);
  }
  clubMarker=marker;

}
google.maps.event.addDomListener(window, 'load', initialize);
