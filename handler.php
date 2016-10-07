<?php
	try{
		/*start session and define paramters*/
		session_start();
		/* load autoloader */
		require_once('helpers/__autoload.php');
		//debug
		App::display_errors(true);
		/* start connection and authentication class*/
		$con=Connection::getInstance();
		$user = new Authentication();
		/*get URL*/
		$request = ($_GET ?? array('request'=>'home'));
		/* starts to handle the url*/
		$handler = new Handler();
		/* check if user is logged*/
		if($user->verifyAuthentication()===false){
			App::redirect();
		}
		/* parse URL and load the page*/
		$handler->parseURL($request);

		$handler->loadController();
		$handler->loadView();

	}catch(Exception $e){
		echo "We have an error with your request: <br>" . $e->getMessage();
	}finally{
		/* close the connection*/
		$con->disconnect();
	}
