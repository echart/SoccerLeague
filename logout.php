<?
	session_start();
	$tree='';

	require_once($tree . 'includes/class/authentication.php');

	$user= new Authentication();
	$user->logout();