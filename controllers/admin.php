<?
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Admin';
$this->data['menu']='admin';
$this->admin = new Admin($_SESSION['SL_account']);
$this->isAdmin=$this->admin->isAdmin();
