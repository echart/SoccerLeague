<?php
require_once('helpers/__country.php');
$this->data['menu']='home';
$this->data['submenu']=0;
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->data['title']='Home';
$this->admin = new Admin($_SESSION['SL_account']);
$this->isAdmin=$this->admin->isAdmin();

$this->addCSSFile('home.css');
$this->addCSSFile('modal.css');
$this->addCSSFile('tweet.css');
$this->addJSFile('tweet.js');
