<?php
	session_start();
	require_once('helpers/__autoload.php');

	try{
		$con=Connection::getInstance();
		$user=new Authentication();

		if($user->verifyAuthentication()===false){ //before all, verify if user have needed authentication
			Authentication::homeRedirect();
		}

		$request = $_GET ?? array('request'=>'home');

		$handler=new Handler();
		$handler->requestURL($request);

		$handler->loadController();
		$handler->loadView();
		
	}catch(Exception $e){
		echo "Error " . $e->getMessage();
	}