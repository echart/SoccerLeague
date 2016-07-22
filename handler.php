<?php
	session_start();
	require_once('helpers/__autoload.php');
	try{
		$con=Connection::getInstance();
		$user=new Authentication();
		if($user->verifyAuthentication()===false){ //before all, verify if user have needed authentication
			Authentication::homeRedirect();
			exit;
		}
		$request = ($_GET ?? array('request'=>'home'));
		$requestURL = $_GET['request'] ?? 'home';
		// $handler=new Handler();
		// $handler->requestURL($_GET ?? array('request'=>'home'));
		// $handler->loadController();
		// $handler->loadView();
		require_once('views/_head.php');
		require_once('views/_header.php');
		require_once('controllers/'.$requestURL.'.php');
		require_once('views/'.$requestURL.'.php');
	}catch(Exception $e){
		echo "We have an error with your request: <br>" . $e->getMessage();
	}finally{
		$con->disconnect();
	}
