<?php
	try{
		/*start session and define paramters*/
		session_start();
		define('SEASON',1);
		ini_set('display_errors',0);
		error_reporting(!E_ALL);
		/* load autoloader */
		require_once('helpers/__autoload.php');
		/*get URL*/
		$request = ($_GET ?? array('request'=>'home'));
		/* start connection and authentication class*/
		$con=Connection::getInstance();
		$user=new Authentication();
		/* starts to handle the url*/
		$handler=new Handler();
		/* check if user is logged*/
		if($user->verifyAuthentication()===false){
			Authentication::homeRedirect();
			exit; // if user isn't authenticated then redirect to frontpage;
		}
		/*else continues*/
		/* parse URL and load the page*/
		$handler->parseURL($request);
		$handler->loadController();
		$handler->loadView();
	}catch(Exception $e){
		/* if Exception then show the error;*/
		echo "We have an error with your request: <br>" . $e->getMessage();
	}finally{
		/* close the connection*/
		$con->disconnect();
	}
