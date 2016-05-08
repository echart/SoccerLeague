<?
header('Content-type: application/JSON');

include('../class/connection.php');
include('../class/account.php');
include('../class/authentication.php');
include('../class/club.php');

$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';

$con=new Connection();
$auth=new Authentication($con->connect(), $email, $pass);
if($auth->checkAuthentication(){
	$return=array('return'=>'success');
}else{
	$return=array('return'=>'denied');
}

echo json_encode($return);
?>