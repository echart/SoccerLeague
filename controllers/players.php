<?
use Players as ThisPlayer;

/**
 * the way to the actual "virtual" path
 */
$this->data['menu']='players';
$this->data['submenu']=0;
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$this->admin = new Admin($_SESSION['SL_account']);
$this->isAdmin=$this->admin->isAdmin();
/**
 * if have id in url then show individual player page, with respective player;
 *  else show all players for club_id storage in session;
 */
if(isset($this->request['id'])){
  if(isset($this->request['method']) and $this->request['method']=='json'){
    $player = ThisPlayer::is($this->request['id']);
    $playerData = $player->loadPlayer($this->request['id']);
    JsonOutput::jsonHeader();
    echo JsonOutput::success($playerData);
    exit;
  }else{
    require_once('helpers/__position.php');
    require_once('helpers/__country.php');
    $this->addCSSFile('player.css');
    $this->addJSFile('playerSkill.js');
    /**
    * LOAD ALL PLAYER ATTR AND PASS IT TO VIEW.
    */
    $id_player=$this->request['id'];
    $player = ThisPlayer::is($id_player);
    $this->data['player']=$player->loadPlayer($id_player);
    $this->data['player']['area']=__fieldArea($player->loadPlayerPositions());
    $this->data['player']['position']=$player->loadPlayerPositions();
    $this->data['player']['REC']="rec[".$player->rec()."]";
    $this->data['player']['SI']=$player->skillIndex();
    $this->data['player']['nickname']='"'.$this->data['player']['nickname'].'"';
    $this->data['title']= $this->data['player']['name'] . ' - SoccerLeague';
    $this->data['player']['club']=Club::getClubNameById($this->data['player']['id_player_club']);
    // $this->data['player']['country']=flag(getCountryByID($player->id_country));
  }

  $this->requestURL='player';
}else{
  $id_club=$_SESSION['SL_account'];
  $this->data['title']='Players';
  $this->data['clubname']='Plantel de ' . Club::getClubNameById($_SESSION['SL_club']);
  /**LOAD DEPENDENCIES*/
  include('helpers/__position.php');
  $this->addJSFile('playerSkill.js');
  $this->addJSFile('playersTable.js');
  $this->addCSSFile('playerspage.css');
  $arrayPlayers=Players::getPlayersByIdClub($_SESSION['SL_club']);
  $i=0;
  foreach ($arrayPlayers as $key => $id_player) {
    $player = new Player($id_player);
    $this->data['playersTable']['line'][$i]=$player->loadPlayer();
    $this->data['playersTable']['line'][$i]['area']=__fieldArea($player->loadPlayerPositions());
    $this->data['playersTable']['line'][$i]['position']=$player->loadPlayerPositions();
    $this->data['playersTable']['line'][$i]['REC']=$player->rec();
    $this->data['playersTable']['line'][$i]['SI']=$player->skillIndex();
    $i++;
  }
  $arrayPlayers=Players::getGoalkeepersByIdClub($_SESSION['SL_club']);
  $i=0;
  foreach ($arrayPlayers as $key => $id_player) {
    $player = new Goalkeeper($id_player);
    $this->data['playersTable']['gk'][$i]=$player->loadPlayer();
    $this->data['playersTable']['gk'][$i]['area']=__fieldArea($player->loadPlayerPositions());
    $this->data['playersTable']['gk'][$i]['position']=$player->loadPlayerPositions();
    $this->data['playersTable']['gk'][$i]['REC']=$player->rec();
    $this->data['playersTable']['gk'][$i]['SI']=$player->skillIndex();
    $i++;
  }
}
