<?
session_start();
require_once('helpers/__autoload.php');
$con=Connection::getInstance();

$user= new Authentication();
if($user->verifyAuthentication()===true){
	header('location: /home/');
}
$refeer= $_GET['refeer']?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Title, tags and meta-->
	<title>Soccer League - The Soccer Management Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon2.png">

	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
 	<meta name="theme-color" content="‪#‎393E41">

</head>
<body>
	<header>
		<figure class='logo'>
			<img src='assets/img/sl_logos/logo.branco.png'>
		</figure>
		<div class='form-login'>
			<form>
				<input type="text" name="login" placeholder='Email'>
				<input type="password" name="password" placeholder='Password'>
				<button class='btn bg-white black-text' type="button">Entrar</button>
			</form>
		</div>
	</header>
	<main>
		<div class='container grid-container'>
			<div class='side grid-35'>
				<figure>
					<img src='assets/img/icon2.png'>
				</figure>
				<h2>Nós amamos futebol!</h2>
				<p>
					Soccer League é a ideia de um jogo de gerenciamento de um clube de futebol para web, com uma match engine baseada em estatísticas reais do futebol com o uso de técnicas de inteligência artificial, e um visualizador de partidas em 2D, como os antigos tempos de Football Manager 2008.
				</p>
				<h6 class= 'title alert-text'>Soccer League é otimizado para: resoluções de 1368x1080, Google Chrome, e necessita obter sua localização.</text>
			</div>
			<div class='grid-65 side bg-white'>
				<div class='club'>
					<h2 class='title'>Crie seu clube!</h2>
					<div class='form-field'>
						<label>Defina a sede</label>
						<div id='map'></div>
					</div>
					<br>
					<div class='form-field'>
						<input type='text' name='clubname' placeholder="Escolha um nome do clube"></input>
					</div>
					<div class='form-field'>
						<button type="button" class='btn bg-success black-text'>Continuar</button>
					</div>
				</div>
				<!-- <div class='account'>
					<h2 class='title'>Crie sua conta!</h2>
					<div class='form-field'>
						<label>Digite seu email:</label>
						<input type='text' name='clubname' placeholder="Digite seu Email"></input>
					</div>
					<div class='form-field'>
						<label>Digite uma senha</label>
						<input type='text' name='clubname' placeholder="Digite sua Senha"></input>
					</div>
					<div class='form-field'>
						<label>Repita a senha</label>
						<input type='text' name='clubname' placeholder="Repita a senha"></input>
					</div>
					<div class='form-field'>
						<button type="button" class='btn bg-success black-text'>Cadastrar</button>
				</div> -->
			</div>
	</main>

	<!-- CSS -->
	<link href="assets/css/login.css" rel='stylesheet'>
	<link href="assets/css/grid.css" rel='stylesheet'>
	<!-- JS -->
	<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script>
	<script>
	function initMap() {
	  var map = new google.maps.Map(document.getElementById('map'), {
	    zoom: 15,
	    center: {lat: -28.643387, lng: 153.612224},
	    mapTypeControl: true,
	    mapTypeControlOptions: {
	        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
	        position: google.maps.ControlPosition.TOP_CENTER
	    },
	    zoomControl: true,
	    zoomControlOptions: {
	        position: google.maps.ControlPosition.LEFT_CENTER
	    },
	    scaleControl: true,
	    streetViewControl: true,
	    streetViewControlOptions: {
	        position: google.maps.ControlPosition.LEFT_TOP
	    }
	  });
  var infoWindow = new google.maps.InfoWindow({map: map});

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

      infoWindow.setPosition(pos);
      infoWindow.setContent('Você está aqui.');
      map.setCenter(pos);
    }, function() {
      handleLocationError(true, infoWindow, map.getCenter());
    });
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(browserHasGeolocation ?
                        'Error: The Geolocation service failed.' :
                        'Error: Your browser doesn\'t support geolocation.');
}

	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4&callback=initMap" async defer></script>
</body>
</html>
