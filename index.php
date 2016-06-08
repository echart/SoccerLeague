<?
session_start();
require_once('helpers/__autoload.php');
$con=Connection::getInstance();

$user= new Authentication();
if($user->verifyAuthentication()===true){
	header('location: /club/');
}
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Title, tags and meta-->
	<title>Soccer League - The Soccer Manager Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/icon2.png">
	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
 	<meta name="theme-color" content="‪#‎393E41">
 	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="assets/css/login.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/header.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/footer.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/video.css">
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
</head>
<body>
	<header>
		<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
		<ul class='menu'>
			<li><label onclick='expandLogin()' class='btn-login'>Login</label></li>
		</ul>
		<div class='menu-responsive'></div>
	</header>
	<div class='video'>
		<video preload='none' loop="loop" muted>
			<source src="assets/video/splash_home3.mp4" type="video/mp4">
			<img src="assets/img/backgrounds/bg1.jpg">				
		</video>
		<div class="pattern"></div>
		<div class='cadastro'>
			<h1>Nós amamos futebol! <i class="football"></i></h1>
			<h4>e nós vamos fazer o melhor jogo de gerenciamento de futebol, com você! Crie um clube e ajude no desenvolvimento.</h4>
			<label onclick='expandSignin()' class='btn'>Cadastrar-se</label>
		</div>
		<div class='down'><a href='#description'><img src="assets/img/login/down.png"></a></div>
	</div>
    <div class='viewlogin ex'>
    	<span onclick='expandLogin()' class='close'></span>
    	<div>
	    	<h4>Entrar no seu clube</h4>
	    	<input type='text' name='userlogin' placeholder='Email'>
	    	<input type='password' name='userpass' placeholder='Senha'>
	    	<button onclick="login()">Realizar login</button><br>
	    	<span class='forget'><a href=''>Esqueci minha senha</a></span>
	    	<h5 class='return'></h5>
	    </div>
    </div>
    <div class='viewsign ex'>
    	<span onclick='expandSignin()' class='close'></span>
    	<div>
	    	<h4>Boa sorte, sua jornada rumo a glória começa aqui.</h4>
	    	<input type='text' name='clubname' placeholder='Nome do clube'>
	    	<input type='text' name='userlogin1' placeholder='Email'>
	    	<input type='password' name='userpass1' placeholder='Senha'>
	    	<input type='password' name='reuserpass1' placeholder='Digite novamente a Senha'>
	    	<select id='country'></select>
	    	<button onclick='register()'>Criar clube</button>
	    	<h5 class='return'></h5>
	    </div>
    </div>
	<div id='description'>
		<h1>O projeto</h1>
		<p>
			Há mais de cinco anos, com o começo da era dos jogos virtuais, a paixão por futebol sempre fez nascer o desejo de poder representar ligas, jogadores, partidas e etc., tudo que desde antigamente, torcedores já faziam em jogos de botões e competições entre amigos.
			Com isso surgiu a ideia do Soccer League, que tem como principal objetivo ser um game de gerenciamento de um clube de futebol e todos seus aspectos, como estádios, categorias de base, transferências, receitas, despesas, contratos de patrocínio e etc.
			O usuário poderá criar o seu clube, que o mesmo já virá com jogadores vinculados a ele. Assim como também o clube já estará vinculado a sua competição nacional (liga), que é dividida por divisões e grupos. Além da liga, o clube disputará a Copa Nacional. 
			Com isso, o usuário deve escalar seu time e disputar partidas que serão geradas através de uma engine, criada a partir do zero, disputando campeonatos contra seus amigos e outros usuários na luta pelo título de campeão.
			Você pode baixar o relatório completo do projeto clicando <a target='_blank' href='assets/downloads/soccerleague.pdf'>aqui</a>.
		</p>
	</div>
	<div class='user'>
		<div class='login'></div>
		<div class='cadastro'></div>
	</div>
	<footer>
		<div class='rodape'>
			<div class='logo'><h3>SOCCER LEAGUE</h3></div>
			<div class='menu'>©2016 soccerleague.br - Todos os direitos reservados</div>
		</div>
	</footer>

	<!-- JS -->
	<script type="text/javascript">
		var countriesData = [
	    {
	        text: "Brasil",
	        value: 1,
	        selected: false,
	        description: "0 usuários ativos",
	        imageSrc: "assets/img/icons/flags/shiny/48/Brazil.png"
	    }
	];
	</script>
	<script src="assets/js/jquery.js"></script>
	<script type="text/javascript" src='assets/js/select.js'></script>
	<script type="text/javascript" src='assets/js/home/home.min.js'></script>
</body>
</html>
