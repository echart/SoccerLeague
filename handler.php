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
		$handler=new Handler();
		print_r($_GET);
		$handler->requestURL($_GET ?? array('request'=>'home'));
		$handler->loadController();
		$handler->loadView();
	}catch(Exception $e){
		echo "We have an error with your request: <br>" . $e->getMessage();
	}catch(RequestException404 $e){
		echo "404 not found" . $e->getMessage();
	}finally{
		$con->disconnect();
	}
