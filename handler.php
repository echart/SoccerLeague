<?php
	// echo $_SERVER['DOCUMENT_ROOT'];exit;
	try{
		/*start session and define paramters*/
		/* load autoloader */
		require_once('helpers/__autoload.php');
		//debug
		App::display_errors(true);
		/* start connection and authentication class*/
		$con=Connection::getInstance();
		$user = new Authentication();
		/*get URL*/
		$request = $_GET ?? array('request'=>'index');
		/* starts to handle the url*/
		$handler = new Handler();
		/* check if user is logged*/
		if($user->verifyAuthentication()==false){
			$doNotLogged = array('index','signup','login');
			if(!in_array($request['request'],$doNotLogged))
				App::redirect($request['request'],'index');
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
