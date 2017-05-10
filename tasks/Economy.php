<?
$hash = $_GET['hash'];
if(isset($hash) and $hash == 'da39a3ee5e6b4b0d3255bfef95601890afd80709'){
  //requires
  require_once('../classes/Connection.php');
  require_once('../classes/Club.php');
  require_once('../classes/ClubFinances.php');
  require_once('../classes/League.php');
  require_once('../classes/Player.php');
  require_once('../classes/Goalkeeper.php');
  require_once('../classes/Lineplayer.php');

  $id_clubs = array();
  echo 'Starting...<br>';
  //GET ALL CLUBS
  echo 'getting all clubs...<br>';
  $query = Connection::getInstance()->connect()->prepare("SELECT id_club FROM club_finances ORDER BY id_club ASC");
  $query->execute();
  while($data=$query->fetch(PDO::FETCH_ASSOC)){
    $id_clubs[] = $data['id_club'];
  }
  echo 'FOREACH CLUB<br>';
  foreach ($id_clubs as $id_club) {
    //TV
    $id_league = Club::getClubIDLeague($id_club);
    $league = new League();
    $league->id_league = $id_league;
    $league->__load();
    $tv_base = 11000000;
    $tv = $tv_base - (1000000 * $league->division);
    echo 'calculating tv money...<br>';
    // merchandise
    echo 'calculating merchandise...<br>';
    // patrocinador
    echo 'calculating sponsor...<br>';
    // wage
    $query = Connection::getInstance()->connect()->prepare("SELECT id_player FROM players where id_player_club=:id_club group by id_player order by id_player");
    $query->bindParam(":id_club",$id_club);
    $query->execute();
    $i=0;
    $wages=0;
    while($data=$query->fetch(PDO::FETCH_OBJ)){
      $player = Player::__this($data->id_player);
      $player->__loadinfo();
      $wages += $player->wage();
    }
    echo 'calculating wages...<br>';
    // maintenance
    // interests
    // INSERT RESULTS ON club_finances, club_finances_weekly and club_finances_season
  }

}else{
  echo 'you shall not pass';
}
