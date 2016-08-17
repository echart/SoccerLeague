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
	<main>
		<div class='login'>
			<div>
				<h1>Entrar</h1>
				<div class='form-field'>
					<label for='login-input'>Email:</label>
					<input id='login-input' type='text' placeholder='Digite seu email'>
				</div>
				<div class='form-field'>
					<label for='login-input'>Senha:</label>
					<input id='login-input' type='password' placeholder='Digite sua senha'>
				</div>
				<div class='form-field'>
					<button type='button'>Login</button>
				</div>
				<div class='form-field right'>
					<a href=''>Esqueceu a senha?</a>
				</div>
			</div>
		</div>
		<header>
			<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
			<nav>
				<ul>
					<li><a href=''>O que é?</a></li>
					<li><a href=''>Regras</a></li>
					<li><a href='' class='signup'>Cadastrar</a></li>
				</ul>
			</nav>
			<button onclick='callLogin()' class='btn-login'>Entrar</button>
		</header>
		<div class='video'>
			<video preload='none' loop="loop" muted>
				<source src="assets/video/splash_home2.mp4" type="video/mp4">
			</video>
			<div class="pattern"></div>
			<div class='cadastro'>
				<h3>Nós amamos futebol! <i class="football"></i></h3>
				<h4>e nós vamos fazer o melhor jogo de gerenciamento de futebol, com você! Crie um clube e ajude no desenvolvimento.</h4>
			</div>
			<!-- <div class='down'><a href='#description'><img src="assets/img/login/down.png"></a></div> -->
		</div>
	</main>

	<!-- CSS -->
	<link href="assets/css/login.css" rel='stylesheet'>
	<link href="assets/css/grid.css" rel='stylesheet'>
	<!-- JS -->
	<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script>
	<script>
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
			$('.btn-login').html('Fechar');
		}else{
			$('.login').css('height','0px');
			$('.btn-login').html('Entrar');
		}
	}
	</script>

</body>
</html>
