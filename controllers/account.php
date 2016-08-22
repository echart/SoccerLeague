<?
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Opções';
$this->data['menu']='options';
$this->data['submenu']=0;
$this->admin = new Admin($_SESSION['SL_account']);
$this->isAdmin=$this->admin->isAdmin();

if(isset($this->request['subrequest'])){
  switch ($this->request['subrequest']) {
    case 'save':
    extract($_POST);
    if($type=='email'){
      $auth = new Authentication();
      $can=$auth->verifyLogin($oldemail,$password);
      if($can==true){
        $account = Account::getAccount($_SESSION['SL_account']);
        $account->setEmail($email);
        $valid=$account->validEmail();
        if($valid==true){
          $update=$account->update();
          header('Location: saved');
        }else{
          header('Location: email');
        }
      }else{
        header('Location: error');
      }
    }else if($type=='timezoneandlanguage'){
      $account = Account::getAccount($_SESSION['SL_account']);
      $account->setLanguage($language);
      $account->setTimezone($timezone);
      $account->update();
      header('Location: saved');
    }else if($type='password'){
      $auth = new Authentication();
      $can=$auth->verifyLogin($oldemail,$oldpassword);
      if($can==true AND $newpassword==$newpasswordR){
        $account = Account::getAccount($_SESSION['SL_account']);
        $account->setPassword($newpassword);
        $update=$account->update();
        if($update==true){
          header('Location: saved');
        }else{
          header('Location: error');
        }
      }else{
        header('Location: error');
      }
    }
    break;
    case 'saved':
    echo "<script>window.addEventListener('load', function(){ newAlert('success','Dados salvos',6000,'top'); }, false ); </script>";
    break;
    case 'error':
    echo "<script>window.addEventListener('load', function(){ newAlert('danger','Houve um erro ao atualizar os dados.',6000,'top'); }, false ); </script>";
    break;
    case 'email':
    echo "<script>window.addEventListener('load', function(){ newAlert('danger','Email já existe em nossa base de dados',6000,'top'); }, false ); </script>";
    break;
  }
}

$this->data['timezones']=Timezone::getTimezones();
$this->data['languages']=Language::getLanguages();

$account=Account::getAccount($_SESSION['SL_account']);
$this->data['email']=$account->getEmail();
