<?php
require_once('helpers/__country.php');
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'league';

$subrequest = $this->get['subrequest'] ?? '';

$division = $this->get['div'] ?? $_SESSION['SL_div'];
$group = $this->get['group'] ?? $_SESSION['SL_group'];
$country = strtoupper($this->get['country']) ?? strtoupper($_SESSION['SL_country']);

if(!isset($this->request['country'])) // if country isnt set at url, make the redirect to club league set in session
  header('location: '.App::url().'league/'.strtolower($_SESSION['SL_country']).'/'.$division.'/'.$group);

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
      $c = getCountryByID(getCountryID($country));
      $this->data['league']['country'] = $c['country'];
      $i=0;
      while($data=$table->fetch()){
        $data['played']=$competition->gamesplayed;
        $this->data['league']['table'][$i]=$data;
        $i++;
      }

      $LeagueFixture = new LeagueFixture($league->id_league);
      $x = $LeagueFixture->__nextMatches();
      $i=0;
      while($data=$x->fetch()){
        $this->data['league']['next-matches'][$i]=$data;
        $query=Connection::getInstance()->connect()->prepare("SELECT home,away from matches where id_match=:id_match");
    		$query->bindParam(':id_match', $data['id_match']);
    		$query->execute();
    		$match=$query->fetch(PDO::FETCH_OBJ);
        $this->data['league']['next-matches'][$i]['home'] = Club::getClubNameById($match->home);
        $this->data['league']['next-matches'][$i]['homeID'] = $match->home;
        $this->data['league']['next-matches'][$i]['away'] = Club::getClubNameById($match->away);
        $this->data['league']['next-matches'][$i]['awayID'] = $match->away;
        $i++;
      }
      // $this->data['league']['next-matches'] = $



      $this->addCSSFile('league.css');
      $this->addCSSFile('responsive.table.css');
      $this->addJSFile('responsive.table.js');
    }
    break;
}
