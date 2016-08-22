<?
ini_set('display_errors',0);
error_reporting(E_WARNING);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<!-- Title and Tags-->
	<title><?=$this->data['title']?> - Soccer League</title>
	<link rel="icon" type="image/png" sizes="96x96" href="<?=$this->data['tree']?>assets/img/icon2.png">
	<meta name="viewport" content="width=device-width"/>
	<meta name="description" content="Soccer Management Game" />
	<meta name="keywords" content="soccer, management, football, league, game, soccergame, soccerleague" />
	<meta name="author" content="SoccerLeague" />
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="<?=$this->data['tree']?>assets/css/grid.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->data['tree']?>assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->data['tree']?>assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="<?=$this->data['tree']?>assets/css/fonts.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?

	$this->loadCSSFiles();
	$account=Account::getAccount($_SESSION['SL_account']);
	?>
	<script>
	var digital = new Date();
	digital.setHours(<?php echo Timezone::setTimezone(Timezone::getTimezone($account->timezone)); ?>);
	</script>
</head>
<body>
<div id='alert' class='alert'></div>
