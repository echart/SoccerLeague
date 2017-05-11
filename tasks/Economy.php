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
    $club = new Club($id_club);
    $finance = new ClubFinances($club);
    $id_league = Club::getClubIDLeague($id_club);
    $league = new League();
    $league->id_league = $id_league;
    $league->__load();

    $money = $finance->__wallet();

    //TV
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
    // maintenances
    $maintenances = 0;
    $maintenances += $tg * 1250000; // training grounds
    $maintenances += $yt * 1250000; // youth development
    $maintenances += $medical * 475000; //medical center
    $maintenances += $physio * 275000; //physio
    $maintenances += $parking * 375000; //parking
    $maintenances += $toilets * 375000; //toilets
    $maintenances += $lights * 200000; //floodlights
    $maintenances += $hotdog * 35000; //hotdog
    $maintenances += $store * 150000; //club store
    $maintenances += $restaurant * 75000; //restarant
    $maintenances += $marketing * 200000; //marketing deparment
    $maintenances += $draining * 100000; //pitch draining
    $maintenances += $cover * 75000; //pitch cover
    $maintenances += $sprinklers * 100000; //Spriklers
    $maintenances += $heating * 350000; //heating
    // result and interests
    $C = $money + ($tv) - ($wages);
    $base = ($C > 0) ? 8 : 9.5;
    $mr = $C + (($C*$base)/100);
    echo 'calculating interests...<br>';
    // INSERT RESULTS ON club_finances, club_finances_weekly and club_finances_season
  }

}else{
  echo 'you shall not pass';
}
