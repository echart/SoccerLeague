<?
	session_start();

	require_once('includes/functions/__autoload.php');
	
	$user= new Authentication();
	$user->logout();
	