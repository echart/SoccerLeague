<?
	session_start();
	require_once('includes/functions/__autoload.php');

	$con=new Connection();
	$user= new Authentication($con->connect());

	$user->logout();