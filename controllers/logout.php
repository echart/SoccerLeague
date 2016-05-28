<?
	session_start();

	require_once('../helpers/__autoload.php');
	
	$user= new Authentication();
	$user->logout();
	