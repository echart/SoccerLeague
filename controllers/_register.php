<?
require_once('../class/Validation.php');
require_once('../class/Connection.php');
require_once('../class/Account.php');
require_once('../class/Club.php');
require_once('../class/JsonOutput.php');


try{
	if($_POST['refeer']!='') $refeer=$_POST['refeer'];else $refeer=NULL;
	$email=$_POST['login'] ?? '';
	$pass=$_POST['password'] ?? '';
	$pass2=$_POST['rpassword'] ?? '';
	$clubname=$_POST['clubname'] ?? '';
	$country=$_POST['country'] ?? '';

	Validation::validate($pass)->isNotEmpty()->isEqual($pass2);
	Validation::validate($email)->isNotEmpty();
	Validation::validate($clubname)->isNotEmpty()->minLenght(8);
	Validation::validate($country)->isNotEmpty();

	if(Validation::$errorsNum>0){
		for ($i=0; $i < Validation::$errorsNum ; $i++) {
			throw new Exception(Validation::$errorsMsg[$i]);
		}
	}
}catch(Exception $e){
	echo JsonOutput::error($e->getmessage(),'Houve um erro com a o cadastro.');
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
			if($club->id_account!=""){
				$club->setClubName($clubname);
				$club->setCountry($country);
				if($club->checkAvailableClub()==0){
					// TODO: criar nova liga/grupo
				}
				$response=$club->create();
				if($response==false){
					// TODO: deletar conta, já que houve erro na criação do clube
				}else{
						echo JsonOutput::success(array('clubname'=>$club->getClubName()));
				}
			}
		}else{
			throw new Exception("Invalid clubname", 1);
		}
	}else{
		throw new Exception("Invalid email", 1);
	}
}catch(Exception $e){
	echo JsonOutput::error('exception',$e->getmessage());
}finally{
	$con->disconnect();
}
