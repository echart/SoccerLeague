<?php
require_once('helpers/__country.php');
include('helpers/__date.php');
$this->tree=__rootpath($_SERVER['REDIRECT_URL']);

$this->title   ='Home';
$this->menu    = 'home';
$this->submenu = 'home';


$query = Connection::getInstance()->connect()->prepare("SELECT * from matches where (home=:id_club or away=:id_club) and day >= DATE(now()) limit 1");
$query->bindParam(':id_club',$_SESSION['SL_club']);
$query->execute();
$query->setFetchMode(PDO::FETCH_OBJ);
$data=$query->fetch();
$this->data['next-match']['id_match']=$data->id_match;
$this->data['next-match']['location']=$data->id_location;
if($data->type=='L'){
  $id_league = Club::getClubIDLeague($_SESSION['SL_club']);
  $league = new League();
  $league->id_league = $id_league;
  $league->__load();
  $this->data['next-match']['competition'] = $league->name;
}
$this->data['next-match']['day'] = __date($data->day);
$this->data['next-match']['hour'] = $data->hour;
$this->data['next-match']['home']['name']=Club::getClubNameById($data->home);
$this->data['next-match']['home']['id']=$data->home;
$this->data['next-match']['away']['name']=Club::getClubNameById($data->away);
$this->data['next-match']['away']['id']=$data->away;

$this->addCSSFile('home.css');
$this->addCSSFile('feed.css');
$this->addJSFile('feed.js');
