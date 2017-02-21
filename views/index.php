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
	<? $this->loadCSSFiles(); ?>
</head>
<body>
	<header>

	</header>
	<main>
		<div class='byte'>
			<div class='bit-1 logo'>
				<figure>
					<img src="<?=$this->tree?>assets/img/logo.png">
				</figure>
				<h3>Soccer League é um jogo de gerenciamento de futebol em fase de testes(beta). Crie seu clube e colabore no desenvolvimento</h3>
			</div>
			<div class='bit-1'>
				<div class="box" id='home'>
					<div class='box-title'>Login</div>
					<div class='box-content'>
						<form action='/login' method='POST'>
							<input type='text' name='email' placeholder='Email'>
							<input type='password' name='password' placeholder='password'>
							<button type="submit">Login</button>
							<p><?=$_SESSION['errors_login']?></p>
						</form>
					</div>
				</div>
				<div class="box" id='signup'>
					<div class='box-title'>Cadastro</div>
					<div class='box-content'>
						<form action='/signup' method='POST'>
							<input type='text' name='email' placeholder='Email'>
							<input type='password' name='password' placeholder='password'>
							<input type='text' name='clubname' placeholder='Clubname'>
							<select name='country'>
								<option value='br'>Brasil</option>
							</select>
							<input type='hidden' name='refeer' value='<?=$refeer?>'>
							<button type="submit">Criar clube</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	<?
		$_SESSION['errors_login']='';
	?>
	<!-- JS -->
	<script src='<?=$this->tree?>assets/js/jquery.js'></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script> -->
	<!-- <script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script> -->
</body>
</html>
