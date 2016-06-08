<?
error_reporting(!E_WARNING);
extract($this->__headData);
extract($this->__headerData);
extract($this->__viewData);	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<!-- Title and Tags-->
	<title>Soccer League - The Soccer Manager Game</title>
	<link rel="icon" type="image/png" sizes="96x96" href="<?=$tree?>img/icon2.png">
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
	<link rel="stylesheet" type="text/css" href="<?=$tree?>assets/css/loader.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>assets/css/fonts.css">
	<script src="<?=$tree?>assets/js/jquery.js"></script>
	<script src="<?=$tree?>assets/js/loader.js"></script>
	<script type="text/javascript" src='<?=$tree?>assets/js/login/menu.js'></script>

</head>
<body>
	<div id="loader"></div>