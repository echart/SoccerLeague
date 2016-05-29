<?php
	session_start();
	require_once('helpers/__autoload.php');

	try{

		$request = $_GET ?? array('request'=>'home');

		$con=Connection::getInstance();
		$handler=new Handler();
		$handler->requestURL($request); //passing all the $_GET array to handler

		$user=new Authentication();
		if($user->verifyAuthentication()==false){
			header('location: http://' .  $_SERVER['SERVER_NAME']);
		}

		$handler->loadController();
		$handler->loadView();

	}catch(Exception $e){
		echo "Error " . $e->getMessage();
	}