<?
error_reporting(E_ALL);
try{
  $validation = new Validation($_GET);
  $rules = [
  	'login' => 'notin:users|required|email',
    'password' => 'required|minsize:8',
    'clubname' => 'required|minsize:8',
    'country' => 'required'
  ];
  $validation->addRules($rules)->validate();
}catch(Exception $e){
  $_SESSION['errors_signup']='Por favor, preencha corretamente todos os dados :)';
	App::redirect('signup','index');
}finally{
  echo 'olar';
  $account=new Account();
  exit;
}
