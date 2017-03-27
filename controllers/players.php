<?
require_once('helpers/__country.php');
$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'squad';

if(isset($this->request['id'])){
  $this->menu  = "squad";
  $this->submenu = 'players';
  $player = Player::__this($this->get['id']);
  $player->__loadinfo();
  $this->title = $player->name;
  $player->__loadskills();
  $history = $player->__loadhistory();
  $i=0;
  while($data=$history->fetch()){
    $this->data['history'][$i]=$data;
    $this->data['history'][$i]->club=Club::getClubNameById($data->id_club);
    $i++;
  }
  $player->__loadpositions();
  $player->__loadappearance();
  $player->skillIndex();
  $this->data['player'] = $player;
  $this->data['player']->clubname = Club::getClubNameById($player->id_club);

  $this->requestURL='player';
  $this->addCSSFile('player.css');
  $this->addJSFile('player.appearance.js');
  $this->addJSFile('player.skills.js');
  // var_dump($this->data['player']['history']);
  // exit;
}else{
  $this->title = "Elenco";
  $this->menu  = "squad";
  $this->submenu = 'players';
  /*
  LINEPLAYERS
  */
  $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players inner join players_position using(id_player) where id_player_club=:id_club and id_position!=1 group by id_player order by id_player");
  $query->bindParam(":id_club",$_SESSION['SL_club']);
  $query->execute();
  while($data=$query->fetch(PDO::FETCH_OBJ)){
    $player = Player::__this($data->id_player);
    $player->__loadinfo();
    $player->__loadskills();
    // $player->__loadhistory();
    $player->__loadpositions();
    $player->skillIndex();
    $this->data['players']['line'][]=$player;
  }
  /*
  Goalkeeper
  */
  $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players inner join players_position using(id_player) where id_player_club=:id_club and id_position=1 group by id_player order by id_player");
  $query->bindParam(":id_club",$_SESSION['SL_club']);
  $query->execute();
  while($data=$query->fetch(PDO::FETCH_OBJ)){
    $player = Player::__this($data->id_player);
    $player->__loadinfo();
    $player->__loadskills();
    $player->__loadhistory();
    $player->__loadpositions();
    $player->skillIndex();
    $this->data['players']['gk'][]=$player;
  }
  $this->addCSSFile('players.css');
  $this->addJSFile('players.filters.js');
  $this->addJSFile('player.skills.js');
}
