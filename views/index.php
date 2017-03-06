<?
$refeer= $_GET['refeer']?? NULL;
?>
<!DOCTYPE html>
<html>
<head>
	<!-- Title and Tags-->
	<title><?=$this->title?></title>
	<!-- <link rel="icon" type="image/png" sizes="96x96" href="<?=$this->tree?>assets/img/icon.png"> -->
	<meta charset='UTF-8'>
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague"/>
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/lemonade.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/fonts.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->tree?>assets/css/modal.css">
	<? $this->loadCSSFiles(); ?>
</head>
<body>
	<div class='pattern'></div>
	<div class='errors <? if(!isset($_SESSION['E_LOGIN']) or $_SESSION['E_LOGIN']=='') echo "hidden";?>'>
		<p><?=$_SESSION['E_LOGIN'];?></p>
	</div>
	<header>
		<figure class='logo'>
			<img src="<?=$this->tree?>assets/img/logo.png" width="200px">
		</figure>
	</header>

	<main>
		<div class='byte'>
			<div class='bit-1 logo'>
				<h1>É hora de criar seu clube e ser campeão.</h1>
				<p>Soccerleague é um game simulador de gerenciamento de futebol, estamos em desenvolvimento mas gostariamos muito da sua participação. Crie seu clube, contrate jogadores, escale seu time, participe de competições vencendo seus amigos e outros técnicos. Seja campeão e ajude-nos a desenvolver!</p>
				<div class='buttons'>
					<label class='btn1' for="modal_signup">Criar clube</label>
					<label class='btn1' for="modal_login">Acessar clube</label>
				</div>
			</div>
		</div>
	</main>
	<input type="checkbox" id="modal_login" />
	<div class="modal">
	  <div class="modal-content">
			<div class='form'>
		    <h3>Acessar clube</h3>
				<form action='/login' method='POST'>
					<label for='login'>Email:</label>
					<input type="text" name="email" id='login' placeholder="Email">
					<label for='password'>Password:</label>
					<input type="password" name="password" id='password' placeholder="Password">
					<button type="submit" name="button">Acessar</button>
					<a href='#' class='forgot-password'>Esqueceu sua senha?</a>
				</form>
			</div>
			<label class="modal-close" for="modal_login"></label>
	  </div>
		<div class='modal-pattern'></div>
	</div>
	<input type="checkbox" id="modal_signup" />
	<div class="modal">
	  <div class="modal-content">
			<div class='form'>
		    <h3>Criar clube:</h3>
				<form action='/signup' method='POST'>
					<label for='login'>Email:</label>
					<input type="text" name="login"id='login' placeholder="Email">
					<label for='password'>Password:</label>
					<input type="password" name="password" id='password' placeholder="Password">
					<label for='password'>País:</label>
					<select name='country'>
						<option value="1">Brasil</option>
					</select>
					<button type="submit" name="button">Cadastrar</button>
				</form>
			</div>
			<label class="modal-close" for="modal_signup"></label>
	  </div>
		<div class='modal-pattern'></div>
	</div>
	<?
	$_SESSION['E_LOGIN']='';
	?>
	<!-- JS -->
	<script src='<?=$this->tree?>assets/js/jquery.js'></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script> -->
	<!-- <script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script> -->
</body>
</html>
