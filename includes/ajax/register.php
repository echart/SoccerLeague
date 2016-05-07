<?
header('Content-type: application/JSON');

include('../class/connection.php');
include('../class/account.php');

$email=$_GET['login'] ?? '';
$pass=$_GET['password'] ?? '';

try{
	if($email=='' or $pass==''){
		$return=array('return'=>'empty');
		throw new Exception("error,empty email or pass", 1);
	}else if(strlen($pass)<8){
		$return=array('return'=>'pass');
		throw new Exception("error, pass < 8 caracters", 1);
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
		if($x->clubname()>0){
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