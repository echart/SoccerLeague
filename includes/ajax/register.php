<?
header('Content-type: application/JSON');

include('../class/connection.php');
include('../class/account.php');

$email=$_GET['login'] ?? '';
$pass=$_GET['password'] ?? '';
$pass2=$_GET['rpassword'] ?? '';
$club=$_GET['clubname'] ?? '';
$country=$_GET['country'] ?? '';
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
	}else if($club=='' or $country==''){
		$return=array('return'=>'empty2');
		throw new Exception("error,empty club or country", 1);
	}
}catch(Exception $e){
	echo json_encode($return);
	exit;
}

try{
	$con=new Connection();
	$x=new CreateAccount($con->connect(), $email, $pass);

	if($x->check()>0){
		$return=array('return'=>'email');
	}else{
		if($x->clubname($club)>0){
			$return=array('return'=>'club');
		}else{
			$x->create();		
		}
	}
}catch(Exception $e){
	$return=array('return'=>$e->getMessage());
}
echo json_encode($return);
$con->disconnect();