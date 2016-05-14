<?
header('Content-type: application/JSON');

include('../class/connection.php');
include('../class/account.php');
include('../class/userentication.php');
include('../class/club.php');

$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';

$con=new Connection();
$user=new Login($con->connect(), $email, $pass);

if($user->verifyLogin()){
	$user->login();
	$return=array('return'=>'success');
}else{
	$return=array('return'=>'denied');
}

echo json_encode($return);

$con->disconnect();
?>