<?
  include('../class/Connection.php');
  include('../class/Club.php');
  include('../class/League.php');
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
    $query=Connection::getInstance()->connect()->prepare("INSERT INTO competition (id_competition_type, season, id_country, totalclubs) values (:id_competition_type,:season,:id_country,:totalclubs)");
    $query->bindParam(':id_competition_type',$id_competition_type);
    $query->bindParam(':season',$season);
    $query->bindParam(':id_country',$id_country);
    $query->bindParam('totalclubs',$teams);
    $query->execute();
    $id_competition=Connection::getInstance()->connect()->lastInsertID('competition_id_competition_seq');

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
      if(!League::checkIfLeagueAlreadyExists($season,$country,$next[0],$next[1])){
        $league=League::createLeague($id_competition,'Campeonato Brasileiro',$country,$division,$group);
      }
      $league=new League($season,$country,$next[0],$next[1]);
      $next=$league->nextAvailableDivAndGroup();
      /*-----
      add league_table
      ------*/
      if($season==1){
        $query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where id_country:id_country");
        $query->bindParam(':id_country',$id_country);
        $query->execute();
        while($data=$query->fetch(PDO::FETCH_OBJ)){
          $league->joinClub($data->id_club);
        }
      }else{
        # TODO: get all season data in the past, verified the positions and make new league tables;
      }

    }
  }
