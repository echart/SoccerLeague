<?
$user=new Authentication();
if($user->verifyLogin($this->post['email'],$this->post['password'])){
	$user->login();
	App::redirect('login','home');
}else{
	$_SESSION['E_LOGIN']='Usuário e senha inválidos';
	App::redirect('login','index');
}
$con->disconnect();
exit;
?>
