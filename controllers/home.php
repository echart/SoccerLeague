<?php
require_once('helpers/__country.php');
$this->tree=__rootpath($_SERVER['REDIRECT_URL']);

$this->title   ='Home';
$this->menu    = 'home';
$this->submenu = 'home';

$this->addCSSFile('home.css');
