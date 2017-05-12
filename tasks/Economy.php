<?
$hash = $_GET['hash'];
if(isset($hash) and $hash == 'da39a3ee5e6b4b0d3255bfef95601890afd80709'){
  error_reporting(E_ALL);
  ini_set('display_errors',1);
  //requires
  require_once('../classes/Connection.php');
  require_once('../classes/Club.php');
  require_once('../classes/ClubFinances.php');
  require_once('../classes/ClubFacilities.php');
  require_once('../classes/ClubFans.php');
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
    $facilities = new ClubFacilities($club);
    $facilities->__load();
    $id_league = Club::getClubIDLeague($id_club);
    $league = new League();
    $league->id_league = $id_league;
    $league->__load();
    $money = $finance->__wallet();
    $moneyStart = $finance->__wallet();
    //TV
    $tv_base = 11000000;
    $tv = $tv_base - (1000000 * $league->division);
    echo 'calculating tv money...<br>';
    // merchandise
    $merchandise = 0;
    $merchandise = (($facilities->store * 25) * ClubFans::howManyFans($id_club));
    echo 'calculating merchandise...<br>';
    // patrocinador
    //require_once('../tasks/Sponsors.php');
    $sponsors = 0;
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
    $maintenances += $facilities->tg * 1150000; // training grounds
    $maintenances += $facilities->yd * 1150000; // youth development
    $maintenances += $facilities->medical * 325000; //medical center
    $maintenances += $facilities->physio * 275000; //physio
    $maintenances += $facilities->parking * 325000; //parking
    $maintenances += $facilities->toilets * 325000; //toilets
    $maintenances += $facilities->lights * 150000; //floodlights
    $maintenances += $facilities->hotdog * 35000; //hotdog
    $maintenances += $facilities->store * 150000; //club store
    $maintenances += $facilities->restaurant * 75000; //restarant
    $maintenances += $facilities->marketing * 120000; //marketing deparment
    $maintenances += $facilities->draining * 100000; //pitch draining
    $maintenances += $facilities->cover * 75000; //pitch cover
    $maintenances += $facilities->sprinklers * 100000; //Spriklers
    $maintenances += $facilities->heating * 350000; //heating
    // result and interests
    $C = $money + ($tv + $merchandise + $sponsors) - ($wages + $maintenances);
    $interests_base = ($C > 0) ? 8 : 8.75;
    $interests = (($C*$interests_base)/100);
    $mr = $C + $interests;
    $total = $mr - $moneyStart;
    echo 'calculating interests...<br>';
    // INSERT RESULTS ON club_finances, club_finances_weekly and club_finances_season
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_finances where id_club=:id_club ");
    $query->bindParam(':id_club',$id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    $tickets = $data->tickets;
    $food = $data->food;
    $constructions = $data->constructions;
    $transfers = $data->transfers;

    $query = Connection::getInstance()->connect()->prepare("SELECT week FROM club_finances_weekly where id_club=:id_club order by week desc limit 1");
    $query->bindParam(':id_club',$id_club);
    $query->execute();
    if($query->rowCount()>0){
      $data = $query->fetch(PDO::FETCH_OBJ);
      $week =  $data->week + 1;
    }else{
      $week = 1;
    }

    $query = Connection::getInstance()->connect()->prepare("INSERT INTO public.club_finances_weekly(id_club, week, money, tickets, tv, merchandise,food, sponsor, wage,maintenance, constructions, interests, transfers, total)
    VALUES (:id_club, :week, :money, :tickets, :tv, :merchandise, :food, :sponsor, :wage, :maintenance, :constructions, :interests, :transfers,:total)");
    $query->bindParam(':id_club',$id_club);
    $query->bindParam(':week',$week);
    $query->bindParam(':money',$mr);
    $query->bindParam(':tickets',$tickets);
    $query->bindParam(':tv',$tv);
    $query->bindParam(':food',$food);
    $query->bindParam(':merchandise',$merchandise);
    $query->bindParam(':maintenance',$maintenances);
    $query->bindParam(':sponsor',$sponsors);
    $query->bindParam(':wage',$wages);
    $query->bindParam(':constructions',$constructions);
    $query->bindParam(':interests', $interests);
    $query->bindParam(':transfers', $transfers);
    $query->bindParam(':total', $total);
    $query->execute();

    $query = Connection::getInstance()->connect()->prepare("UPDATE public.club_finances SET money=:money, total=:total, transfers=0,tickets=0, tv=:tv, merchandise=:merchandise,food=0, sponsor=:sponsor, wage=:wage, maintenance=:maintenance, constructions=0, interests=:interests WHERE id_club=:id_club");
    $query->bindParam(':id_club',$id_club);
    $query->bindParam(':money',$mr);
    $query->bindParam(':tv',$tv);
    $query->bindParam(':merchandise',$merchandise);
    $query->bindParam(':maintenance',$maintenances);
    $query->bindParam(':sponsor',$sponsors);
    $query->bindParam(':wage',$wages);
    $query->bindParam(':interests', $interests);
    $query->bindParam(':total',$total);
    $query->execute();
    echo 'updating values...<br>';
  }

}else{
  echo 'you shall not pass';
}
