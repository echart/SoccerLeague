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
	<?$this->loadCSSFiles();?>
</head>
<body>
	<header>
		
	</header>
	<main>
		<div class="full" id='home'>

		</div>
		<div class="full" id='signup'>

		</div>
	</main>
	<!-- JS -->
	<script src='<?=$this->tree?>assets/js/jquery.js'></script>
	<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSf5Vam_PKKaynrG_8KNm2EisbK9f9mz4"></script> -->
	<!-- <script type="text/javascript" src="//rawgit.com/googlemaps/v3-utility-library/master/infobox/src/infobox.js"></script> -->
</body>
</html>
