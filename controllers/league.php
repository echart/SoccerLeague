<?
require_once('helpers/__country.php');
require_once('helpers/__league.php');
$this->data['menu']='league';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);

$division = $this->request['div'] ?? $_SESSION['SL_div'];
$group = $this->request['group'] ?? $_SESSION['SL_group'];
$country = strtoupper($this->request['country']) ?? strtoupper($_SESSION['SL_country']);


if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: http://'.$_SERVER['SERVER_NAME'].'/league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);

$league =  new League(getCountryID($country), SEASON, $division, $group);

$this->data['leagueName']=$league->name;
$this->data['title']=$league->name;
$this->data['division']=$division;
$this->data['group']=$group;

$query=$league->getLeagueTable();

$i=0;
while($data=$query->fetch()){
  $this->data['leagueTable'][$i]=$data;
  if($_SESSION['SL_club']==$data['id_club']){
    $this->data['leagueTable'][$i]['class']='selected';
  }else{
    $this->data['leagueTable'][$i]['class']='';
  }
  $this->data['leagueTable'][$i]['status']=__leagueStatus($division,$i+1);
  $i++;
}
