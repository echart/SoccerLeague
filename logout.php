<?
	session_start();
	$tree='';

	require_once($tree . 'includes/class/authentication.php');
	require_once($tree . 'includes/class/connection.php');

	$con=new Connection();
	$user= new Authentication($con->connect());
	$user->conn=$con;

	$user->logout();