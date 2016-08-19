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
        console.log('carregando');
        newAlert('info','Carregando...',2000,'top');
      },
      success: function(data){
        if(typeof data.error != 'undefined'){
          if(data.error.message=='denied'){
            newAlert('warning','Parece que os dados apresentados não conferem, você não pode entrar no seu clube',10000,'top');
          }
        }
        if(typeof data.data.success != 'undefined'){
          if(data.data.success=='logged'){
            newAlert('success','Login realizado, redirecionando....',2000,'top');
            setTimeout(function(){
              location.reload();
            },1000);
          }
        }
      },
      error: function(data){
        newAlert('warning','Ocorreu um problema :( sorry)',10000,'top');
      }
  });
}
function register(){
  var country=$("input[name='country']").val();
  var login=$("input[name='login']").val();
  var password=$("input[name='userpass1']").val();
  var clubname=$("input[name='clubname']").val();
  if(country=='BR'){
    newAlert('danger','Por enquanto, contamos apenas com a possibilidade de escolha dentro do Brasil',10000,'top');
  }else{
    if(country=='' || login=='' || password=='' || clubname==''){
      newAlert('danger','Preencha todos os campos antes de avançar',2000,'top');
    }else{
      $.ajax({
        url: 'controllers/_register.php',
        type: 'POST',
        dataType: 'json',
        data: {country: $("input[name='country']").val(),refeer: $("input[name='refeer']").val(),login: $("input[name='login']").val(), password:$("input[name='userpass1']").val(),clubname:$("input[name='clubname']").val()},
        beforeSend: function(data){
          newAlert('info','Carregando...',2000,'top');
        },
        success: function(data){
          console.log(data);
          if(typeof data.error != 'undefined'){
            newAlert('warning','Houve um erro ao tentar cadastrar, verifique os dados e tente novamente.',2000,'top');
          }else{
            newAlert('success','Seja bem vindo ao SoccerLeague, seu clube ' + data.data.clubname + ' foi criado com sucesso e os seus jogadores o aguardam para a primeira conversa!',20000,'top');
          }
        },
        error: function(data){
          console.log(data);
          newAlert('warning','O servidor está com um pouco de dificuldade pra lidar com novos cadastros. Tente mais tarde.',2000,'top');
        }
      });
    }
  }
}
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
        if(results[results.length-1].address_components[0].short_name!='BR'){
          newAlert('danger','Por enquanto, contamos apenas com a possibilidade de escolha dentro do Brasil',10000,'top');
        }
        $("input[name='country']").val(results[results.length-1].address_components[0].short_name);
      }
    }
  });
}

/*
load all markers
*/
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
/* initialize map*/
google.maps.event.addDomListener(window, 'load', initialize);
