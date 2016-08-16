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
		<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
		<!-- <nav>
			<ul class='menu'>
				<li><label onclick='expandLogin()' class='btn-login'>Login</label></li>
			</ul>
			<div class='menu-responsive'></div>
		</nav> -->
	</header>
	<main>
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
		<div class='options'>
			<nav>
				<ul>
					<li><a href=''>Regras</a></li>
					<li><a href='' class='signup'>Cadastrar</a></li>
				</ul>
			</nav>
			<button class='btn-login'>Entrar</button>
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
	</script>

</body>
</html>
