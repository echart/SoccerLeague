<?
  include('../class/Connection.php');
  include('../class/Club.php');
  include('../class/League.php');
  include('../class/Competition.php');
  /*----------
  SET COMPETITION DATA
  -----------*/
  $id_competition_type=1;
  $teams=18;
  $total_games=($teams*2)-2;
  /*-------
  GET SEASON AND + 1(NEXT);
  ---------*/
  // $query=Connection::getInstance()->connect()->query("SELECT season FROM season");
  // $query->execute();
  // if($query->rowCount()==0){
  //   $season=1;
  //   $query->execute();
  // }else{
  //   $data=$query->fetch(PDO::FETCH_OBJ);
  //   $season=$data->season+1;
  // }
  $season=1;
  /*-----
  GET ALL COUNTRIES
  -------*/
  $query=Connection::getInstance()->connect()->query("SELECT id_country FROM country");
  $query->execute();
  $countries=array();
  while($data=$query->fetch(PDO::FETCH_OBJ)){
    $countries[]=$data->id_country;
  }
  /*------
  add an competition/league to all countries
  --------*/
foreach ($countries as $key => $id_country) {
    /*----
    ADD competition
    ------*/
    // $query=Connection::getInstance()->connect()->prepare("INSERT INTO competition (id_competition_type, season, id_country, totalclubs) values (:id_competition_type,:season,:id_country,:totalclubs)");
    // $query->bindParam(':id_competition_type',$id_competition_type);
    // $query->bindParam(':season',$season);
    // $query->bindParam(':id_country',$id_country);
    // $query->bindParam('totalclubs',$teams);
    // $query->execute();
    Competition::createCompetition($season,$id_country,$id_competition_type, $teams);
    $id_competition=Connection::getInstance()->connect()->lastInsertID('competition_id_competition_seq');
    echo 'id competição: ' . $id_competition;
    /*------
    COUNT CLUBS AND COUNT HOW MANY LEAGUES/GROUPS WE NEED TO ADD.
    ------*/
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_country=:id_country");
    $query->bindParam(':id_country',$id_country);
    $query->execute();
    $clubs=$query->rowCount();
    /*------
    IF WE DONT HAVE 18 CLUBS FOR A GROUP, CREATE MORE AVAILABLE teams
    -------*/
    if(League::leftClubs($clubs)>0){
      for($i=0;$i<League::leftClubs($clubs);$i++){
        Club::createAvailableTeam($id_country);
      }
    }
    $groups=$clubs/$teams;
    /*------
    ADD league based in groups numbers
    --------*/
    $next=array(1,1);
    for($i=1;$i<=$groups;$i++){
      /*----
      add league
      -----*/
      $div=$next[0];
      $group=$next[1];
      $flag=false;
      if(!League::checkIfLeagueAlreadyExists($season,$id_country,$div,$group)){
        $league=League::createLeague($id_competition,'Campeonato Brasileiro',$id_country,$div,$group, $total_games);
        $flag=true;
      }
      $league=new League($season,$id_country,$div,$group);
      $next=$league->nextAvailableDivAndGroup();
      /*-----
      add league_table
      ------*/
      if($season==1 AND $flag==true){
        $query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where id_country=:id_country");
        $query->bindParam(':id_country',$id_country);
        $query->execute();
        while($data=$query->fetch(PDO::FETCH_OBJ)){
          $id=intval($data->id_club);
          $league->joinClub($id);
        }
      }else{
        # TODO: get all season data in the past, verified the positions and make new league tables;
      }

    }
    echo 'Country ' . $id_country . ' added<br>';
  }
