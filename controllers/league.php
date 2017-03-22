<?php
require_once('helpers/__country.php');
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'league';

$request = $this->get['subrequest'] ?? '';

$division = $this->get['div'] ?? $_SESSION['SL_div'];
$group = $this->get['group'] ?? $_SESSION['SL_group'];
$country = strtoupper($this->get['country']) ?? strtoupper($_SESSION['SL_country']);

if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: http://'.$_SERVER['SERVER_NAME'].'/league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);

switch ($subrequest) {
  case 'value':
    # code...
    break;

  default:
    if(!League::checkIfLeagueAlreadyExists(Season::getSeason(),getCountryID($country),$division,$group)){
      $this->data['league']['nonexists']=true;
    }else{
      $this->submenu = 'league';
      
      $competition = new Competition(Competition::getIdCompetition(getCountryID($country)));
      $competition->__load();

      $league = new League($competition->id_competition,$division,$group);
      $league->__loadIDleague();
      $league->__load();

      $this->title=$league->name;

      $table=$league->__loadtable();
      $this->data['league']['table']=array();
      $this->data['league']['div']=$division;
      $this->data['league']['group']=$group;
      $this->data['league']['countryabbr'] = strtolower($country);
      $i=0;
      while($data=$table->fetch()){
        $data['played']=$competition->gamesplayed;
        $this->data['league']['table'][$i]=$data;
        $i++;
      }



      $this->addCSSFile('league.css');
      $this->addCSSFile('tooltip.css');
    }
    break;
}
