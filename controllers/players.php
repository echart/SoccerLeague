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
  $player->skillIndex();

  $this->addCSSFile('player.css');
  $this->requestURL='player';
  var_dump($player);
  exit;
}else{
  $this->title = "Elenco";
  $this->menu  = "squad";
  $this->submenu = 'players';
  $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players where id_player_club=:id_club");
  $query->bindParam(":id_club",$_SESSION['SL_club']);
  $query->execute();
  while($data=$query->fetch(PDO::FETCH_OBJ)){
    // $player = Player::__this($data->id_player);
    // $player->__loadinfo();
    // $player->__loadskills();
    // $player->__loadhistory();
    // $player->__loadpositions();
    // $player->skillIndex();
    // var_dump($player);
  }
  $this->addJSFile('players.filters.js');
}
