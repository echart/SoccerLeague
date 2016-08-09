<?
require_once('helpers/__country.php');
$this->data['menu']='home';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Home - Soccer League Beta';

$this->addCSSFile('home.css');
$this->addCSSFile('modal.css');
$this->addCSSFile('tweet.css');
$this->addJSFile('tweet.js');
