<?
require_once('helpers/__skill.php');
/**
 * the way to the actual "virtual" path
 */
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
/**
 * if have id in url then show individual player page, with respective player;
 *  else show all players for club_id storage in session;
 */
if(isset($this->request['id'])){
  /**
   * LOAD ALL PLAYER ATTR AND PASS IT TO VIEW.
   */
  $id_player=$this->request['id'];
  $player = new Player();
  $this->data['player']=$player->loadPlayer($id_player);
  $this->data['title']= $this->data['player']->name . ' - SoccerLeague';
}else{
  /**
   * LOAD ALL PLAYERSSSSS ATTR AND PASS IT TO VIEW
   * :TODO make it fast
   */
  $id_club=$_SESSION['SL_account'];
  $players =  new Player();
  $this->data['title']='Players - SoccerLeague';
}
