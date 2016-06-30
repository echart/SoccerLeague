<?
require_once('../class/Validation.php');
require_once('../class/Connection.php');
require_once('../class/Account.php');
require_once('../class/Club.php');
require_once('../class/JsonOutput.php');


try{
	$refeer=$_POST['refeer'] ?? '';
	$email=$_POST['login'] ?? '';
	$pass=$_POST['password'] ?? '';
	$pass2=$_POST['rpassword'] ?? '';
	$clubname=$_POST['clubname'] ?? '';
	$country=$_POST['country'] ?? '';

	$error='';
	$error=Validation::isEqual($pass,$pass2);
	$error.=Validation::isEmpty($email);
	$error.=Validation::isEmpty($pass);
	$error.=Validation::isEmpty($clubname);
	$error.=Validation::minLenght($clubname,8);
	$error.=Validation::isEmpty($country);
	if($error!=''){
		throw new Exception("Has an error with your params", 1);	
	}
}catch(Exception $e){
	echo JsonOutput::error('exception',$e->getmessage());
	exit;
}

try{
	JsonOutput::jsonHeader();
	$con=Connection::getInstance();
	$account=new Account();
	$account->setEmail($email);
	if(($account->validEmail()===true)){
		if((Club::validClubName($clubname)===true)){
			$account->setPassword($pass);
			$account->setRefeer($refeer);

			$club=new Club();
			$club->id_account=$account->create();
			$club->setClubeName($clubname);
			$club->setCountry($country);
			$club->create();

			echo Json::success(array('clubname'=>$club->clubname));
		}else{
			throw new Exception("Invalid clubname", 1);
		}
	}else{
		throw new Exception("Invalid email", 1);
	}
}catch(Exception $e){
	echo Json::error('exception',$e->getmessage());
}finally{
	$con->disconnect();	
}
