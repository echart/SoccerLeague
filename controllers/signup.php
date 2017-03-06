<?
try{
  if(isset($_POST['refeer']) and $_POST['refeer']!='') $refeer=$_POST['refeer'];else $refeer=NULL;
  $email=$_POST['login'] ?? '';
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
   if($email=='')
      throw new Exception('sdasdasd');

}catch(Exception $e){
  $_SESSION['errors_signup']='Por favor, preencha corretamente todos os dados :)';
	App::redirect('signup','index');
}
