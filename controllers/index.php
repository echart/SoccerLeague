<?
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$refeer = $_GET['refeer']?? NULL;
$this->title='Soccer League - The Soccer Management Game';
$this->addCSSFile('index.css');
$this->loadView(false);
exit;
