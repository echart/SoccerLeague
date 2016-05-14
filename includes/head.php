<?php
	session_start();

	require_once($tree . 'includes/class/authentication.php');
	require_once($tree . 'includes/class/connection.php');

	$con=new Connection();
	$user= new Authentication();
	$user->con=$con;

	if($user->verifyAuthentication()==false){
		header('location: http://' .  $_SERVER['SERVER_NAME']);
	}
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
	<link rel="stylesheet" type="text/css" href="<?=$tree?>css/loader.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>css/styles.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>css/header.css">
	<link rel="stylesheet" type="text/css" href="<?=$tree?>css/fonts.css">
	<script src="<?=$tree?>js/jquery.js"></script>
	<script src="<?=$tree?>js/loader.js"></script>
	<script type="text/javascript" src='<?=$tree?>js/login/menu.js'></script>

</head>
<body>
	<div id="loader"></div>