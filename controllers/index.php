<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$refeer= $_GET['refeer']?? NULL;
$this->data['log'] = $_SESSION['logged'] ?? 'não logado';
$this->loadView(false);
exit;
