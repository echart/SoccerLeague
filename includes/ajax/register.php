<?
header('Content-type: application/JSON');

include('../class/Connection.php');
include('../class/CreateAccount.php');
include('../class/Club.php');

$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';
$pass2=$_POST['rpassword'] ?? '';
$clubname=$_POST['clubname'] ?? '';
$country=$_POST['country'] ?? '';
try{
	if($pass!=$pass2){
		$return=array('return'=>'diferentpass');
		throw new Exception("error, passes are diferents", 1);
	}else if($email=='' or $pass==''){
		$return=array('return'=>'empty');
		throw new Exception("error,empty email or pass", 1);
	}else if(strlen($pass)<8){
		$return=array('return'=>'pass');
		throw new Exception("error, pass < 8 caracters", 1);
	}else if($clubname=='' or $country==''){
		$return=array('return'=>'empty2');
		throw new Exception("error,empty club or country", 1);
	}
}catch(Exception $e){
	echo json_encode($return);
	exit;
}

try{
	$con=new Connection();
	$account=new CreateAccount($email, $pass);
	$account->club=$clubname;
	if($account->isset()){
		$return=array('return'=>'email');
	}else{
			$account->create();
			$club=new CreateClub($account->id_account,$country, $clubname);
			$return=$club->create();
	}
}catch(Exception $e){
	$return=array('return'=>$e->getMessage());
}finally{
	echo json_encode($return);
	$con->disconnect();	
}
