<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$refeer= $_GET['refeer']?? NULL;
$this->data['log'] = $_SESSION['logged'] ?? 'não logado';
<<<<<<< HEAD
=======
$this->addCSSFile('index.css');
>>>>>>> 704368058fcf1972fcf600be56480f56c4e06be6
$this->loadView(false);
exit;
