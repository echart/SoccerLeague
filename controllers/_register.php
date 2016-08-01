<?
require_once('../class/Validation.php');
require_once('../class/Connection.php');
require_once('../class/Account.php');
require_once('../class/Club.php');
require_once('../class/JsonOutput.php');


try{
	/**
	 * DATA VALIDATION
	 * passwords must be equals and not blank
	 * email must be not blank
	 * country must be not blank
	 * clubname must be not blank and with minlenght 8
	 */
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
	/**
	 * If any rules break, get errors and throw exception
	 */
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
	/* set email */
	$account->setEmail($email);
	/* verify if email already exists in database*/
	if(($account->validEmail()===true)){
		/* verify if clubname already exists in database*/
		if((Club::validClubName($clubname)===true)){
			/*set data for account*/
			$account->setPassword($pass);
			$account->setRefeer($refeer);
			$club=new Club();
			/* creat account getting account id */
			$club->id_account=$account->create();
			if($club->id_account!=""){
				/*set club data */
				$club->setClubName($clubname);
				$club->setCountry($country);
				/*verify if we have available clubs for this country*/
				if($club->checkAvailableClub()==0){
					/* Create new league with new available clubs */
					$last=League::lastDivAndGroup();
					$league = new League($country,1,$last[0],$last[1]);
					$available=$league->nextAvailableDivAndGroup();
					if(!League::checkIfLeagueAlreadyExists(1,$country,$available[0],$available[1])){
						$id_competition=Competition::getIdCompetition(Competition::getIdCompetitionType('L'),$country, 1);
						League::createLeague($id_competition,$available[0], $available[1], 34);
					}
					$league = new League($country,1,$available[0],$available[1]);
					for($i=1;$i<19;$i++){
					 $club=Club::createAvailableTeam($country);
					 $league->joinClub($club);
					}
				}
				/* create clubs*/
				$response=$club->create();
				if($response==false){
					/**
					 * delete account because we have an error with club creation
					 */
					$account->delete();
					throw new Exception("We have an error :( #sad", 1);
				}else{
						/* create players for this club */
						$id_club=$club->id_club;
						include('PlayerCreator.php');
						/* YAY. All process done! club created! return it.*/
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
	/* return if we have an exception :/ */
	echo JsonOutput::error('exception',$e->getmessage());
}finally{
	/* disconnect database */
	$con->disconnect();
}
