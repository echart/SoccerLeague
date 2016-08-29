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

/*NEXT MATCH*/
$this->data['nextMatch']=LeagueFixture::getNextClubFixture($_SESSION['SL_club']);
$this->data['nextMatch']['leagueInfo']=League::getLeagueById($this->data['nextMatch']['id_league']);
$this->data['nextMatch']['homeTeam']=Club::getClubNameById($this->data['nextMatch']['home']);
$this->data['nextMatch']['awayTeam']=Club::getClubNameById($this->data['nextMatch']['away']);
$this->data['nextMatch']['homeLogo']=ClubInfo::getClubLogo($this->data['nextMatch']['home']);
$this->data['nextMatch']['awayLogo']=ClubInfo::getClubLogo($this->data['nextMatch']['away']);
