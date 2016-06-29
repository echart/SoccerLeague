<?
include('../helpers/__autoload.php');

$refeer=$_POST['refeer'] ?? '';
$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';
$pass2=$_POST['rpassword'] ?? '';
$clubname=$_POST['clubname'] ?? '';
$country=$_POST['country'] ?? '';

JsonOutput::jsonHeader();

try{
	if($pass!=$pass2){

	}else if($email=='' or $pass==''){
		
	}else if(strlen($pass)<8){
		
	}else if($clubname=='' or $country==''){
	
	}
}catch(Exception $e){
	echo json_encode($return);
	exit;
}

try{
	Connection::getInstance();
	$account=new Account();
	$account->setEmail($email);
	if(($account->validEmail()===true) AND (Club::validClubName($clubname)===true)){
		$account->setPassword($pass);
		$account->setRefeer($refeer);

		$club=new Club();
		$club->id_account=$account->create();
		$club->setClubeName($clubname);
		$club->setCountry($country);

		$club->create();
	}
}catch(Exception $e){
	$return=array('return'=>$e->getMessage());
}finally{
	echo json_encode($return);
	$con->disconnect();	
}
