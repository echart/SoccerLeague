<?php
require_once('helpers/__country.php');
$this->tree=__rootpath($_SERVER['REDIRECT_URL']);

$request = $this->get['subrequest'] ?? '';

switch ($subrequest) {
  case 'value':
    # code...
    break;

  default:
    $division = $this->get['div'] ?? $_SESSION['SL_div'];
    $group = $this->get['group'] ?? $_SESSION['SL_group'];
    $country = strtoupper($this->get['country']) ?? strtoupper($_SESSION['SL_country']);

    if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
      header('location: http://'.$_SERVER['SERVER_NAME'].'/league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);


    $competition = new Competition(Competition::getIdCompetition(getCountryID($country)));
    $league = new League($competition->id_competition,$division,$group);
    $league->__loadIDleague();
    $league->__load();
    $this->title=$league->name;
    break;
}
