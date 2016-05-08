<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<!-- Title and Tags-->
	<title>Soccer League - The Soccer Manager Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="img/icon2.png">
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
	<!--CSS-->
	<link rel="stylesheet" type="text/css" href="css/loader.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/login/header.css">
	<link rel="stylesheet" type="text/css" href="css/login/footer.css">
	<link rel="stylesheet" type="text/css" href="css/login/video.css">
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<!--JS-->
	<script src="js/jquery.js"></script>
	<script src="js/loader.js"></script>
</head>
<body>
	<div id="loader"></div>

	<header>
		<div class='logo'><img src='img/sl_logos/logo.branco.png'></div>
		<ul class='menu'>
			<li><label onclick='expandLogin()' class='btn-login'>Login</label></li>
		</ul>
		<div class='menu-responsive'></div>
	</header>
	<div class='video'>
		<video preload='none' loop="loop" muted>
			<source src="video/splash_home3.mp4" type="video/mp4">
			<img src="img/backgrounds/bg1.jpg">				
		</video>
		<div class="pattern"></div>
		<div class='cadastro'>
			<h1>Nós amamos futebol! <i class="football"></i><i class="heart"></i></h1>
			<h4>e nós vamos fazer o melhor jogo de gerenciamento de futebol, com você! Crie um clube e ajude no desenvolvimento.</h4>
			<label onclick='expandSignin()' class='btn'>Cadastrar-se</label>
		</div>
		<div class='down'><a href='#description'><img src="img/login/down.png"></a></div>
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
	    	<select name='country'>
	    		<option selected value=''>Escolha um País</option>
	    		<option value='1'></span>Brasil</option>
	    	</select>
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
	<script type="text/javascript" src='js/login/login.js'></script>
</body>
</html>