<?
header('Content-type: application/JSON');

include('../class/Connection.php');
include('../class/Login.php');
include('../class/Authentication.php');
include('../class/Club.php');

$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';

$con=Connection::getInstance();
$user=new Login($email, $pass);

if($user->verifyLogin()){
	$user->login();
	$return=array('return'=>'success');
}else{
	$return=array('return'=>'denied');
}

echo json_encode($return);

$con->disconnect();
?>