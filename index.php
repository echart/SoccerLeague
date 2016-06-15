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
 	<style>
 		div#description h1,div#description h4{padding:1em 5em 0;text-align:left;color:#333}body{margin:0;padding:0;background-color:#fff;font-family:'Open Sans',sans-serif;overflow-x:hidden;color:#fff}a{text-decoration:none;color:#333;font-size:1.8em}div#description{position:relative;border-top:5px solid #5fad56;width:100%;padding:0 2em 4em 0;text-align:center}div#description h1{font-size:2.5em}div#description h4{font-size:1.5rem}div#description p{font-size:1.25em;padding:0 10em;text-align:justify;color:#333}.button{padding:1em 5em;background-color:#b44230;border:0;color:#fff}div.ex span.forget a{display:block;width:100%;margin-top:30px;font-size:.75rem;color:#fff;text-align:right}div.ex,div.ex div{text-align:center}div.ex button{position:relative;top:10px;padding:.9em 0;width:105%;background-color:#5fad56;color:#fff;font-size:1rem;font-family:'Exo 2',sans-serif;border:0;border-radius:2.5px}div.ex button:hover{background:#4A7856;color:#fff;transition:all .5s;cursor:pointer}div.ex{position:fixed;top:0;left:-340px;height:100vh;width:340px;background:#393E41;z-index:999;transition:left 1s;margin:0 auto;padding-top:2%}div.ex select,div.ex select option{padding:7.5px 5px}div.expanded{left:0!important;transition:left 1s}div.ex select{width:105%}div.ex input{background-color:#fff;display:block;padding:7.5px;margin:.5rem auto;width:100%;font-family:'Exo 2';font-size:1rem}div.ex input:focus,div.ex input:hover{background-color:#EAF4D3}div.ex div{margin:0 auto;width:80%;padding:2rem 0}div.ex span.close{cursor:pointer;position:absolute;right:.75rem;padding:.5rem 1rem;display:block;-moz-box-sizing:border-box;box-sizing:border-box;width:1.2rem;height:1.2rem;background:url(../img/icons/close.png) no-repeat;background-size:1.2rem}.flag-br{display:block;-moz-box-sizing:border-box;box-sizing:border-box;width:24px;height:24px;background:url(../img/icons/flag/br.png) no-repeat;background-size:24px}@media(max-width:900px){div#description{position:relative;width:90%;padding:0 1em}div#description p{font-size:1.25em;padding:0;margin:0;text-align:justify}div#description h1{padding:0;text-align:left}footer{display:none}div.ex input{width:80%}div.ex{width:100vw;left:-100vw}div.ex button{width:82.5%}div.ex span.forget a{display:block;width:90%}}.error,.success{font-family:'Exo 2';padding:10px}.error{color:#EA4335}.success{color:#34A853;font-size:1.4rem}div#country{padding:0;font-size:50%}.dd-select{overflow:hidden!important;display:block!important;padding:0!important;font-weight:700!important;line-height:25px!important}.dd-options{max-height:200px!important}
 		footer,footer div.rodape{width:100%;height:90px}footer{background-color:#222;position:relative;text-align:center}footer div.rodape div.logo{position:absolute;top:1em;left:7.5em}footer div.rodape div.logo img{width:200px}footer div.rodape div.logo h3{font-size:1.2em;color:#fff}footer div.rodape div.menu{position:absolute;top:2.25em;right:7.5em;color:#888}
 		header{width:100%;height:10em;z-index:998;position:absolute}header div.logo{position:absolute;top:3em;left:10%}header div.logo img{width:15em}header ul.menu{list-style:none;position:absolute;right:10%;top:50px}header ul.menu li{float:left;padding:0 1em;color:#fff}input[type=text],input[type=password]{width:220px;height:32.5px;background-color:#e9e7d6;border-radius:1px;border:0;padding-left:5px}header div.menu-responsive{position:absolute;width:32px;height:32px;right:10%;top:3.5em;display:none;background:url(../../img/icons/responsive-menu.png) no-repeat;background-size:24px}.btn-login{margin-top:1rem;border:1px solid #fff;border-radius:5px;padding:.75em 1.5em}.btn-login:hover{cursor:pointer;background-color:rgba(255,255,255,.2);transition:.3s all;color:#fff}.scroll{transition:.3s all;height:6em;position:fixed;background:#4a7856}header.scroll ul.menu{list-style:none;position:absolute;right:10%;top:20px}header.scroll div.logo img{width:12.5em;padding-top:0}header.scroll div.logo{position:absolute;top:1.5em;left:10%}a.scroll{background-color:#fff!important;color:#b44230}header.scroll div.menu-responsive{position:absolute;width:32px;height:32px;right:10%;top:2.15em;background:url(../../img/icons/responsive-menu.png) no-repeat;background-size:24px}@media(max-width:900px){header div.logo img,header.scroll div.logo img{padding-top:.75em;width:7.5em}header div.logo{position:absolute;top:3em;left:10%}}
 		.btn,div.video{position:relative}div.video img{box-sizing:border-box;width:100%;float:left}.btn{top:30px;padding:.75em 3.5em;background-color:#5fad56;color:#fff;font-size:1.4rem;font-family:'Exo 2',sans-serif;border:0;border-radius:50px}div.video div.pattern,video{right:0;top:0;min-width:100%;min-height:100%}.btn:hover{background:#393e41;color:#fff;transition:all .5s;cursor:pointer}header a{text-decoration:none;color:#fff;font-size:1em}header a:hover{color:#ccc;transition:.5s all}div.video{background-color:333;overflow:hidden;height:100vh;width:100vw;background:url(../../img/backgrounds/bg1.jpg) center center/cover no-repeat}div.cadastro,div.down,video{position:absolute}div.video h1{font-size:4rem;padding:0;margin:0}div.video h3{font-size:1rem}div.video div.pattern{opacity:.75;filter:"alpha(opacity=40)";background:url(../../img/login/subtle_carbon.png);position:absolute;z-index:2}video{display:block;width:auto;height:auto;z-index:1}div.cadastro{z-index:3;width:100%;top:17em;left:50%;transform:translateX(-50%);text-align:center;padding:0 1em}.football,.heart{width:64px;height:64px;padding-left:48px}div.cadastro h1{color:#fff}.heart{background:url(../../img/icons/emoji/heart2.png) center no-repeat;background-size:28px}.football{background:url(../../img/icons/emoji/football.png) center no-repeat;background-size:40px}div.down{bottom:10px;z-index:2;width:35px;height:35px;left:50%;margin-left:-17.5px}@media(max-width:900px){div.video h1{font-size:1.2em}div.video h4{padding-right:1rem;font-size:.8em}}@media(max-width:800px){video{display:none}}
	</style>
</head>
<body>
	<header>
		<div class='logo'><img src='assets/img/sl_logos/logo.branco.png'></div>
		<nav>
			<ul class='menu'>
				<li><label onclick='expandLogin()' class='btn-login'>Login</label></li>
			</ul>
			<div class='menu-responsive'></div>
		</nav>
	</header>
	<main>
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
		    	<form>
			    	<input type='text' name='userlogin' placeholder='Email'>
			    	<input type='password' name='userpass' placeholder='Senha'>
			    	<button type='button' onclick="login()">Realizar login</button><br>
			    	<span class='forget'><a href=''>Esqueci minha senha</a></span>
		    	</form>
		    	<h5 class='return'></h5>
		    </div>
	    </div>
	    <div class='viewsign ex'>
	    	<span onclick='expandSignin()' class='close'></span>
	    	<div>
		    	<h4>Boa sorte, sua jornada rumo a glória começa aqui.</h4>
		    	<form>
			    	<input type='text' name='clubname' placeholder='Nome do clube'>
			    	<input type='text' name='userlogin1' placeholder='Email'>
			    	<input type='password' name='userpass1' placeholder='Senha'>
			    	<input type='password' name='reuserpass1' placeholder='Digite novamente a Senha'>
			    	<select id='country'></select>
			    	<button type='button' onclick='register()'>Criar clube</button>
			    </form>
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
	</main>
	<footer>
		<div class='rodape'>
			<div class='logo'><h3>SOCCER LEAGUE</h3></div>
			<div class='menu'>©2016 soccerleague.br - Todos os direitos reservados</div>
		</div>
	</footer>
	<!-- CSS -->
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/login.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/header.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/footer.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login/video.min.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/css/fonts.css">
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
	<!--<script>document.write('<script src=assets/js/' +('__proto__' in {} ? 'zepto' : 'jquery') +'.js><\/script>')</script-->
	<script type="text/javascript" src='assets/js/jquery.js'></script>
	<script type="text/javascript" src='assets/js/select.js'></script>
	<script type="text/javascript" src='assets/js/home/home.min.js'></script>
</body>
</html>
