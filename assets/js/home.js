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
      method: 'POST',
      dataType: 'JSON',
      data: {login: $("input[name='userlogin']").val(), password:$("input[name='userpass']").val()},
      beforeSend: function(){
        $('.viewlogin .return').html('');
        $('.viewlogin button').html('Carregando');
      },
      success: function(data){
        $('.viewlogin button').html('Realizar login');
        if(data.return=='denied'){
        $('.viewlogin .return').html('<br>Parece que os dados apresentados não conferem, você não pode entrar no seu clube');
        }else{
          $('.viewlogin .return').html('Sucesso, redirecionando...');
          setTimeout(function(){
            location.reload();
          },1000);
        }
      },
      error: function(data){
        console.log(data.responseText);
        $('.viewlogin button').html('Realizar login');
        $('.viewlogin .return').html('');
      }
  });
}
function register(){
  if($('#country').data('ddslick').selectedData==null){
    $('.viewsign .return').html('Ainda há dados a serem preenchidos.');
  }
  $.ajax({
      url: 'controllers/_register.php',
      method: 'POST',
      dataType: 'json',
      data: {refeer: $("input[name='refeer']").val(),login: $("input[name='userlogin1']").val(), password:$("input[name='userpass1']").val(), rpassword:$("input[name='reuserpass1']").val(), clubname:$("input[name='clubname']").val(), country: $('#country').data('ddslick').selectedData.value},
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
function initialize() {

  var styleArray = [
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
  ];

  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(40.6743890, -73.9455),
    styles: styleArray
  };

  var map = new google.maps.Map(document.getElementById('map'),
    mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);
