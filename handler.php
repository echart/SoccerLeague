<?php
	try{
		session_start();
		define('SEASON',1);
		require_once('helpers/__autoload.php');
		$request = ($_GET ?? array('request'=>'home'));
		$con=Connection::getInstance();
		$user=new Authentication();
		$handler=new Handler();
		if($user->verifyAuthentication()===false){
			Authentication::homeRedirect();
			exit; // if user isn't authenticated then redirect to frontpage;
		}
		$handler->parseURL($request);
		$handler->loadController();
		$handler->loadView();
	}catch(Exception $e){
		/* if Exception then show the error;*/
		echo "We have an error with your request: <br>" . $e->getMessage();
	}finally{
		$con->disconnect();
	}
