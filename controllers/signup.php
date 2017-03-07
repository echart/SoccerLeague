<?
error_reporting(E_ALL);
try{
  $email=$_POST['email'] ?? '';
  $pass=$_POST['password'] ?? '';
  $clubname=$_POST['clubname'] ?? '';
  $country=$_POST['country'] ?? '';
  Validation::validate($pass)->isNotEmpty();
  Validation::validate($email)->isNotEmpty();
  Validation::validate($clubname)->isNotEmpty()->minLenght(8);
  Validation::validate($country)->isNotEmpty();
  /**
   * If any rules break, get errors and throw exception
   */
   if(Validation::$errorsNum>0){
     for ($i=0; $i < Validation::$errorsNum ; $i++) {
       throw new Exception(Validation::$errorsMsg[$i]);
     }
   }
}catch(Exception $e){
  $_SESSION['errors_signup']='Por favor, preencha corretamente todos os dados :)';
	App::redirect('signup','index');
}finally{
  echo 'olar';
  $account=new Account();
  exit;
}
