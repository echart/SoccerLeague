<html>
  <head>
    <? $this->loadCSSFiles(); ?>
    <style media="screen">
        *{
          margin: 0;
          padding: 0;
        }
        #map{
          width: 100vw;
          height: 100vh;
        }
        .controls{
          position: absolute;
          bottom: 0;
          width: 100vw;
          z-index: 9999;
          background: #333;
          padding: 15px 0px;
        }
        button{
          margin-right: 20px;
          padding: 15px 25px;
          border: 0px;
          border-radius: 2px;
          background-color: #5FAD56;
          color: #26292B;
          font-size: 15px;
          font-weight: 700;
          color: #fcfcfc;
        }
        .right{
          float: right;
        }
        .left{
          float: left;
        }
        .soccerleague{
          margin-top: -7px;
          margin-left: 20px;
          background-image: url(../assets/img/logo.png) !important;
        }
    </style>
  </head>
  <body>
    <div class='controls'>
      <div class='soccerleague left'></div>
      <button class='right'>Criar Clube</button>
    </div>
    <div id="map"></div>
    <script src='<?=$this->tree?>assets/js/jquery.js'></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script>
    <script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script>
    <script>
    var map;
    var infobox;
    var clubMarker=null;
    var markers=[];
    var image = {
      url: 'assets/img/icons/pin.png',
      // This marker is 20 pixels wide by 32 pixels high.
      size: new google.maps.Size(32,32),
      // The origin for this image is (0, 0).
      origin: new google.maps.Point(0, 0),
      // The anchor for this image is the base of the flagpole at (0, 24).
      anchor: new google.maps.Point(0, 32)
    };
    var you = {
      url: 'assets/img/icons/flag.png',
      // This marker is 20 pixels wide by 32 pixels high.
      size: new google.maps.Size(32,32),
      // The origin for this image is (0, 0).
      origin: new google.maps.Point(0, 0),
      // The anchor for this image is the base of the flagpole at (0, 24).
      anchor: new google.maps.Point(16, 32)
    };
    function initialize() {
      var mapOptions = {
        disableDefaultUI: true,
        zoom: 6,
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
          loadAllMarkers();
          geocodeLatLng(geocoder,pos);
          infoWindow.setPosition(pos);
          infoWindow.setContent('<p>Sua localização atual é esta! A localização de outros clubes é indicada através de uma bola de futebol! Você pode mover o seu clube para qualquer lugar do mapa, mas tenha sabedoria ao escolher. <h3>O país escolhido representa a liga nacional pelo qual seu clube jogará!</h3> E você não terá possibilidade de mudança. Além disso, a escolha de localidade possibilita maior interação entre os usuários, campeonatos regionais e etc...</p>');
          map.setCenter(pos);
          addMarker(pos,true);
        }, function() {
          var pos = {
            lat: -31.769234899999994,
            lng: -52.3391811
          };
          loadAllMarkers();
          geocodeLatLng(geocoder,pos);
          infoWindow.setPosition(pos);
          infoWindow.setContent('Sua localização atual é esta! A localização de outros clubes é indicada através de uma bola de futebol! Você pode mover o seu clube para qualquer lugar do mapa, mas tenha sabedoria ao escolher. <h3>O país escolhido representa a liga nacional pelo qual seu clube jogará!</h3> E você não terá possibilidade de mudança. Além disso, a escolha de localidade possibilita maior interação entre os usuários, campeonatos regionais e etc...');
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
    function addMarker(location,flag) {
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
    function loadAllMarkers(){
      $.getJSON("api/location/all",function(response){
        // console.table(response.data);
        for(var i=0;i<response.data.length;i++){
          var pos={lat:Number(response.data[i].latitude),lng:Number(response.data[i].longitude)}
          var marker = new google.maps.Marker({
            position: pos,
            map: map,
            icon: image,
            id: response.data[i].id_club,
            clubname: response.data[i].clubname,
            manager: response.data[i].manager,
            logo: response.data[i].logo
          });
          markers[i]=marker;
          google.maps.event.addListener(marker, 'click', function() {
            if(this.logo=='null') this.logo='default.png';
            infobox.content_.children[0].innerHTML="<img width='50px' height='50px' src='assets/img/logos/"+this.logo+"'>";
            infobox.content_.children[1].innerHTML="<h3>"+this.clubname+" <small>[ "+this.manager+" ]</small></h3>";
            infobox.open(map, this);
            map.panTo(pos);
          });
        }
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
