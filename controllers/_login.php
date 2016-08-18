<?
include('../class/Connection.php');
include('../class/Authentication.php');
include('../class/Club.php');
include('../class/JsonOutput.php');

JsonOutput::jsonHeader();
$email=$_POST['login'] ?? '';
$pass=$_POST['password'] ?? '';

$con=Connection::getInstance();
$user=new Authentication();

if($user->verifyLogin($email,$pass)){
	$user->login();
	echo JsonOutput::success(array('success'=>'logged'));
}else{
	echo JsonOutput::error('error','denied');
}

$con->disconnect();
?>
