<?
use Players as ThisPlayer;

/**
 * the way to the actual "virtual" path
 */
$this->data['menu']='players';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
/**
 * if have id in url then show individual player page, with respective player;
 *  else show all players for club_id storage in session;
 */
if(isset($this->request['id'])){
  if($this->request['method']=='json'){
    $player = ThisPlayer::is($this->request['id']);
    $playerData = $player->loadPlayer($this->request['id']);
    JsonOutput::jsonHeader();
    echo JsonOutput::success($playerData);
    exit;
  }else{

  }
  /**
   * LOAD ALL PLAYER ATTR AND PASS IT TO VIEW.
   */
  $id_player=$this->request['id'];
  $player = ThisPlayer::is($id_player);
  $this->data['player']=$player->loadPlayerInfo($id_player);
  $this->data['title']= $this->data['player']['name'] . ' - SoccerLeague';
}else{
  $id_club=$_SESSION['SL_account'];
  $this->data['title']='Players';
  $this->data['clubname']='Plantel de ' . Club::getClubNameById($_SESSION['SL_club']);
  /**LOAD DEPENDENCIES*/
  $this->addJSFile('playerSkill.js');
  $this->addCSSFile('playerspage.css');

  $arrayPlayers=Players::getPlayersByIdClub($_SESSION['SL_club']);
  $i=0;
  foreach ($arrayPlayers as $key => $id_player) {
    $player = new Player();
    $this->data['playersTable']['line'][$i]=$player->loadPlayer($id_player);
    $this->data['playersTable']['line'][$i]['position']=$player->loadPlayerPositions($id_player);
    $i++;
  }
  $arrayPlayers=Players::getGoalkeepersByIdClub($_SESSION['SL_club']);
  foreach ($arrayPlayers as $key => $id_player) {
    $player = new Goalkeeper();
    $this->data['playersTable']['gk'][]=$player->loadPlayer($id_player);
  }
}
