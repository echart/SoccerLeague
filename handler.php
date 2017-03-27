<?php
	// echo $_SERVER['DOCUMENT_ROOT'];exit;
	try{
		/*start session and define paramters*/
		/* load autoloader */
		require_once('helpers/__autoload.php');
		//debug
		App::display_errors(TRUE);
		/* start connection and authentication class*/
		$con=Connection::getInstance();
		$user = new Authentication();
		/*get URL*/
		$request = $_GET ?? array('request'=>'index');
		/* starts to handle the url*/
		$handler = new Handler();
    $handler->post=$_POST;
    $handler->get=$_GET;
		/* check if user is logged*/
		if($user->verifyAuthentication()==false){
			$doNotLogged = array('index','signup','login','SeasonStart'); //page that user can access if not logged
			if(!in_array($request['request'],$doNotLogged))
				App::redirect($request['request'],'index');
		}else{
			if($request['request']=='index')
				App::redirect($request['request'],'home');
		}
		/* parse URL and load the page*/
		$handler->parseURL($request);
		$handler->loadController();
		$handler->loadView();
	}catch(Exception $e){
		echo "We have an error with your request: <br>" . $e->getMessage();
		echo $e->getFile()." line ".$e->getLine()."<br>";
	}finally{
		/* close the connection*/
		$con->disconnect();
	}
