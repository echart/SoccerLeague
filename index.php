<?
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
		<div class='signup'>
			<div class='grid-35'>
				<h1>Crie uma equipe!</h1>
				<h5>Escolha a localização do seu clube no mapa ao lado! A localização definirá que campeonatos seu clube irá jogar.</h5>
				<form method='POST'>
					<div class='form-field'>
						<label for='clubname'>Nome do clube:</label>
						<input type='text' name='clubname' placeholder='Escolha um nome para seu clube'>
						<input type='hidden' name='refeer' value='<?=$_GET['refeer'] ?? '';?>'>
						<input type='hidden' name='country' value=''>
						<input type='hidden' name='lat' value=''>
						<input type='hidden' name='lng' value=''>
					</div>
					<div class='form-field'>
						<label for='email'>Email:</label>
						<input id='email' type='text' name='login' placeholder='Digite seu email'>
					</div>
					<div class='form-field'>
						<label for='userpass1'>Senha:</label>
						<input name='userpass1' id='userpass1' type='password' placeholder='Digite sua senha'>
					</div>
					<div class='form-field'>
						<button type='button' onclick='register()'>Cadastrar</button>
					</div>
				</form>
			</div>
			<div class='grid-65'>
				<div id='map'>loading map....</div>
			</div>
			<div class='infobox-wrapper'>
				<div id='infowindow'>
					<div class='logo'>
						<img src='' width="50px" height="50px">
					</div>
					<div class='description'>
						<h3>Grêmio FBPA <small>[Willians Echart]</small></h3>
					</div>
				</div>
			</div>
		</div>
		<div class='login'>
			<div class='form'>
				<h1>Entrar</h1>
				<form>
					<div class='form-field'>
						<label for='login-input'>Email:</label>
						<input id='login-input' type='text' name='userlogin' placeholder='Digite seu email'>
					</div>
					<div class='form-field'>
						<label for='pass-input'>Senha:</label>
						<input id='pass-input' name='userpass' type='password' placeholder='Digite sua senha'>
					</div>
					<div class='form-field'>
						<button type='button' onclick='login()' >Login</button>
					</div>
					<div class='form-field right'>
						<a href=''>Esqueceu a senha?</a>
					</div>
				</form>
			</div>
		</div>
    <div class='about'>
      <img src='assets/img/sl_logos/logo.branco.png'>
      <p>
        Soccer League é a ideia de um jogo de gerenciamento de um clube de futebol para web, com uma match engine baseada em estatísticas reais do futebol com o uso de técnicas de inteligência artificial, e um visualizador de partidas em 2D, como os antigos tempos de Football Manager 2008.
      </p>
      <p>
        O game consiste em criar um clube de futebol que será atribuido a liga nacional do país escolhido, assim você disputa com dezenas de outros técnicos pelo acesso a liga principal e o titulo nacional. Ao longo dessa jornada, o técnico tem muitas outras competições, amistosos e etc. e para atingir o principal objetivo deve escalar, gerenciar estádio, gerenciar economia, vender ou contratar jogadores, e etc.
      </p>
      <p>
        E este projeto é utilizado como trabalho de conclusão do Curso de Tecnologia em Sistemas para Internet do Instituto Federal de Educação, Ciência e Tecnologia Sul-Riograndense.
      </p>
    </div>
    <div class='rules'>
      <h1>Manual de boa convivência do game: <i class="heart"></i><i class="football"></i></h1>
      <h3>É estritamente proibido:</h3>
      <p>+ Em qualquer que seja o meio(Mensagens, Tweets, Fórum) é estritamente proibido fazer uso de palavras, termos ou qualquer outra forma de expressão, que seja de carater ofensivo, ilegal ou racista. Também não é permitido o envio de SPAM através dos nossos canais de comunicação entre usuários.</p>

      <p>+ Trapacear de qualquer forma.</p>
      <p>+ Tentar arruinar o jogo de alguém de alguma forma</p>
      <p>+ Obter ou manipular dados de qualquer parte do site, de forma não autorizada, assim também como automatizar partes do game.</p>
      <p>+ <b>Possuir mais de um login/conta/clube</b> é totalmente proibido. Assim também como controlar conta de amigo/parente. Cada clube/conta/login é de uso pessoal e instransferível.</p>
      <p>+ Agir contra a lógica de qualquer clube no futebol, isto inclui, vender todos os jogadores, arruinar a economia do clube e etc..</p>
      <button class='btn btn-signup' onclick='call("signup")'>Jogar</button>
    </div>
		<header>
			<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
			<nav>
				<ul>
					<li><a href='#' onclick='call("about")' class='btn-about'>Sobre</a></li>
					<li><a href='#' onclick='call("rules")' class='btn-rules'>Regras</a></li>
					<li><a href='#' onclick='call("signup")' class='btn-signup'>Cadastrar</a></li>
				</ul>
			</nav>
			<button onclick='call("login")' class='btn-login'>Entrar</button>
		</header>
		<div class='video'>
			<video preload='none' loop="loop" muted>
				<source src="assets/video/splash_home3.mp4" type="video/mp4">
			</video>
			<div class="pattern"></div>
			<div class='cadastro'>
				<h3>Nós amamos futebol! <i class="football"></i><i class="heart"></i></h3>
				<h4>e nós vamos fazer o melhor jogo de gerenciamento de futebol, com você! Crie um clube e ajude no desenvolvimento.</h4>
			</div>
			<!-- <div class='down'><a href='#description'><img src="assets/img/login/down.png"></a></div> -->
		</div>
		<!-- <div class='alert visible alert-bottom alert-info'>
				<p>Jogo otimizado para resolução 1366x768, e localização compartilhada. </p>
		</div> -->
		<div id='alert' class='alert'></div>
	</main>

	<!-- CSS -->
	<link href="assets/css/login.css" rel='stylesheet'>
	<link href="assets/css/grid.css" rel='stylesheet'>
	<!-- JS -->
	<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script>
	<script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script>
	<script src='assets/js/alert.js'></script>
	<script src='assets/js/index.js'></script>
</body>
</html>
