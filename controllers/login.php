<?
// echo 'login';exit;
include('../class/Connection.php');
include('../class/Authentication.php');
include('../class/Club.php');
include('../class/JsonOutput.php');

JsonOutput::jsonHeader();
$email=$_POST['email'] ?? '';
$pass=$_POST['password'] ?? '';

$con=Connection::getInstance();
$user=new Authentication();

if($user->verifyLogin($email,$pass)){
	$user->login();
	App::redirect('login','home');
}else{
	$_SESSION['errors_login']='Usuário e senha inválidos';
	App::redirect('login','index');
}
exit;

$con->disconnect();
?>
