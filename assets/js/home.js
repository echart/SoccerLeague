$(document).ready(function(){
  var video = document.querySelector("video");
  video.addEventListener("ended", function(){
    video.play();
  });
  if(document.body.clientWidth >= 900) {
    $('video').attr('autoplay', true);
    $('video').attr('preload', 'auto');
  }
});
function callLogin(){
  if($('.login').css('height')=='0px'){
    $('.login').css('height','88.75vh');
    $('.signup').css('height','0px');
    $('.btn-login').html('Fechar');
    $('a.signup').html('Cadastrar')

  }else{
    $('.login').css('height','0px');
    $('.btn-login').html('Entrar');
  }
}
function callSignup(){
  if($('.signup').css('height')=='0px'){
    $('.login').css('height','0px');
    $('.signup').css('height','88.75vh');
    $('.btn-login').html('Entrar');
    $('a.signup').html('Fechar')
  }else{
    $('.signup').css('height','0px');
    $('a.signup').html('Cadastrar')
  }
}
function login(){
  $.ajax({
      url: 'controllers/_login.php',
      type: 'POST',
      dataType: 'json',
      data: {login: $("#login-input").val(), password:$("#pass-input").val()},
      beforeSend: function(data){
        $('.alert-top').removeClass('bg-warning white-text');
        $('.alert-top').addClass('bg-white black-text');
        console.log('carregando');
        $('.alert-top').addClass('visible');
        $('.alert-top p').html('Carregando');
      },
      success: function(data){
        $('.alert-top').addClass('visible');
        $('.viewlogin button').html('Realizar login');
        console.log(data);

        if(typeof data.error != 'undefined'){
          if(data.error.message=='denied'){
            $('.alert-top').removeClass('bg-white black-text');
            $('.alert-top').addClass('bg-warning white-text');
            $('.alert-top p').html('Parece que os dados apresentados não conferem, você não pode entrar no seu clube');
          }
        }
        if(typeof data.data.success != 'undefined'){
          if(data.data.success=='logged'){
            $('.alert-top').removeClass('bg-white black-text');
            $('.alert-top').removeClass('bg-warning white-text');
            $('.alert-top').addClass('bg-success white-text');
            $('.alert-top p').html('Login realizado, redirecionando....');
            setTimeout(function(){
              location.reload();
            },1000);
          }
        }
      },
      error: function(data){
        console.log(data);
        $('.alert-top').removeClass('bg-white black-text');
        $('.alert-top').addClass('bg-warning white-text');

        console.log('erro');
        $('.alert-top p').html('Ocorreu um problema :( sorry)');
      }
  });
}
function register(){
  if($('#country').data('ddslick').selectedData==null){
    $('.viewsign .return').html('Ainda há dados a serem preenchidos.');
  }
  $.post({
      url: 'controllers/_register.php',
      type: 'POST',
      dataType: 'json',
      data: {refeer: $("input[name='refeer']").val(),login: $("input[name='login']").val(), password:$("input[name='userpass1']").val(),clubname:$("input[name='clubname']").val()},
      beforeSend: function(data){
        $('.viewsign .return').html('');
        $('.viewsign button').html('Carregando');
      },
      success: function(data){
        if(typeof data.error != 'undefined'){
          response=data.error.code;
          console.log(data);
        }else{
          response='Seja bem vindo ao SoccerLeague, seu clube ' + data.data.clubname + ' foi criado com sucesso e os seus jogadores o aguardam para a primeira conversa!';
          console.log(data);
        }
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html(response);
      },
      error: function(data){
        console.log(data);
        $('.viewsign button').html('Criar clube');
        $('.viewsign .return').html('Estamos enfrentando um problema com o cadastro, tente novamente daqui a pouco!');
      }
  });
}
var map;
var clubMarker=null;
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
    zoom: 12,
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

  map = new google.maps.Map(document.getElementById('map'),
    mapOptions);
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
        infoWindow.setContent('Sua localização atual é esta! A localização de outros clubes é indicada através de uma bola de futebol! Você pode mover o seu clube para qualquer lugar do mapa, mas tenha sabedoria ao escolher. <h3>O país escolhido representa a liga nacional pelo qual seu clube jogará!</h3> E você não terá possibilidade de mudança. Além disso, a escolha de localidade possibita maior interação entre os usuários, campeonatos regionais e etc...');
        addMarker(pos,true);
        map.setCenter(pos);
      }, function() {
        handleLocationError(true, infoWindow, map.getCenter());
      });
    }

    map.addListener('click', function(event) {
      geocodeLatLng(geocoder,event.latLng);
      addMarker(event.latLng, false);
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
/*
RETURNS COUNTRY BASED ON THE USER marker
*/
function geocodeLatLng(geocoder, pos) {
  var latlng =pos;
  geocoder.geocode({'location': latlng}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[1]) {
        console.log(results[results.length-1].address_components[0].short_name);
      }
    }
  });
}

/*
load all markers
*/
function loadAllMarkers(){
  $.getJSON("api/location/all",function(response){
    console.log(response.data.length);
    for(var i=0;i<response.data.length;i++){
      var pos={lat:Number(response.data[i].latitude),lng:Number(response.data[i].longitude)}
      console.log(pos);
      var marker = new google.maps.Marker({
        position: pos,
        map: map,
        icon: image
      });
    }
  });
}

/* initialize map*/
google.maps.event.addDomListener(window, 'load', initialize);
