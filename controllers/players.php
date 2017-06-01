<?
include('helpers/__country.php');
include('helpers/_rec.php');

$this->tree    =__rootpath($_SERVER['REDIRECT_URL']);
$this->menu    = 'squad';
if(isset($this->request['id'])){
  if(isset($this->post['fireplayer'])){
    JsonOutput::jsonHeader();
    $player = new Player($this->request['id']);
    $player->__fire();
    echo JsonOutput::success(array('success'));
    exit;
  }
  $this->menu  = "squad";
  $this->submenu = 'players';
  $player = Player::__this($this->get['id']);
  $player->__loadinfo();

  if(isset($this->post['sellplayer'])){
    $id_player = $this->request['id'];
    if($_SESSION['SL_club']==$player->id_club){
      $value = str_replace('.','',$this->post['value']);
      $value = str_replace(',','.',$value);
      $enddate = DateTime::createFromFormat("d/m/Y H:i:s", $this->post['endDate']);
      $end = $enddate->format('Y-m-d H:i:s');
      $query = Connection::getInstance()->connect()->prepare("INSERT INTO transferlist (id_player,endDate,value) values (:id_player,:enddate,:value)");
      $query->bindParam(':id_player',$id_player);
      $query->bindParam(':enddate',$end);
      $query->bindParam(':value',$value);
      $query->execute();
      $tweet = "Colocou o jogador <a href='".$this->tree."player/".$player->id_player."'>$player->name</a> à venda por um valor de $". number_format($value,2,',','.');
      Tweet::__tweet($_SESSION['SL_club'],'M',$tweet,null,$reply_to);
    }
  }else if(isset($this->post['buyplayer'])){
    if($_SESSION['SL_club']!=$player->id_club){
      $transfer=$player->__listed();
      $query = Connection::getInstance()->connect()->prepare("UPDATE transferlist SET id_bid_club=:id_bid_club,value=:value where id_player=:id_player and status=TRUE");
      $query->bindParam(':id_bid_club',$_SESSION['SL_club']);
      $value = (($transfer['value']*4)/100)+$transfer['value'];
      $query->bindParam(':value',$value);
      $query->bindParam(':id_player',$this->request['id']);
      $query->execute();
      //exit;
    }
  }

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
  $player->wage();
  $this->data['player'] = $player;
  $this->data['player']->wage = number_format($player->wage,2,',','.');
  $this->data['player']->clubname = Club::getClubNameById($player->id_club);

  $this->requestURL='player';
  $this->addCSSFile('player.css');
  $this->addCSSFile('tactics.css');
  $this->addCSSFile('modal.css');
  $this->addJSFile('player.appearance.js');
  $this->addJSFile('player.skills.js');
  $this->addJSFile('player.positions.js');
  $this->addJSFile('mask.js');
  $this->addJSFile('player.options.js');
  $this->addCSSFile('responsive.table.css');
  $this->addJSFile('responsive.table.js');
  // var_dump($this->data['player']);
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
    $player->wage();
    $player->wage = number_format($player->wage,2,',','.');
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
    $player->wage();
    $player->wage = number_format($player->wage,2,',','.');
    $this->data['players']['gk'][]=$player;
  }
  $this->addCSSFile('players.css');
  $this->addJSFile('players.filters.js');
  $this->addJSFile('player.skills.js');
  $this->addCSSFile('responsive.table.css');
  $this->addJSFile('responsive.table.js');
}
