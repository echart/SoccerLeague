<?
// echo 'login';exit;
include('../class/Connection.php');
include('../class/Authentication.php');
include('../class/Club.php');
include('../class/JsonOutput.php');

JsonOutput::jsonHeader();
$email = $this->post['email'] ?? '';
$pass  = $this->post['password'] ?? '';

$con=Connection::getInstance();
$user=new Authentication();

if($user->verifyLogin($this->email,$pass)){
	$user->login();
	App::redirect('login','home');
}else{
	$_SESSION['errors_login']='Usuário e senha inválidos';
	App::redirect('login','index');
}
exit;

$con->disconnect();
?>
