<?

require_once('helpers/__country.php');
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'squad';

if(isset($this->request['id'])){

  $player = Player::__this($this->get['id']);
  $player->__loadinfo();
  $player->__loadskills();
  $player->__loadhistory();
  $player->__loadpositions();

  $this->addCSSFile('player.css');
  $this->requestURL='player';
  var_dump($player);
  exit;
}else{

}
