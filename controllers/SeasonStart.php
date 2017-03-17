<?
  /*----------
  SET COMPETITION DATA
  -----------*/
  $id_competition_type=1;
  $teams=18;
  $total_games=($teams*2)-2;
  $league_startday='2017-03-17';
// echo date('Y-m-d',strtotime("+0 days",strtotime($league_startday)));
// exit;
  $league_startday2=2;
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
  $query=Connection::getInstance()->connect()->query("SELECT id_country FROM countries");
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
    $competition = new Competition();
    $competition->__create($season,$id_country,Competition::getIdCompetitionType('L'),$teams,$total_games,true);
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
        Club::__createAvailableTeam($id_country);
      }
    }
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_country=:id_country");
    $query->bindParam(':id_country',$id_country);
    $query->execute();
    $clubs=$query->rowCount();
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
      // $flag=false;
      $league=false;
        // if(!League::checkIfLeagueAlreadyExists($season,$id_country,$div,$group)){
      $league = new League();
      $league->__create($competition->id_competition, 'Brazil League', $div,$group);
      $flag=true;
      // }
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
        $leaguetable=$league->getLeagueTable();
        $teams=array();
        //get all club ia a league group
        while($data=$leaguetable->fetch()){
          $teams[]=$data['id_club'];
        }
        $fixture = new GenerateFixture();
        $firstHalf=$fixture->firsthalf($teams);
        $secondHalf=$fixture->secondHalf($firstHalf);
        $z=0;
        $i=0;
        foreach($firstHalf as $key => $games){
          $round=$key+1;
          $league_startday=date('Y-m-d',strtotime("+".$i." days",strtotime($league_startday)));
          $w=date('w',strtotime($league_startday));
          switch ($w) {
            case 3:
              $i=2;
              break;
            case '5':
              $i=2;
              break;
            case '0':
              $i=3;
              break;
          }
          if(date('w',strtotime($league_startday))==3 or date('w',strtotime($league_startday))==5 or date('w',strtotime($league_startday))==0){
            echo ($league_startday ."<Br>");
            //save date at calendar with competitiontype
            $query=Connection::getInstance()->connect()->prepare("INSERT INTO calendar (season,id_competition_type,day) values (:season,:id_competition_type,:matchday)");
            $query->bindParam(":season",$season);
            $query->bindParam(":id_competition_type",$id_competition_type);
            $query->bindParam(":matchday",$league_startday);
            $query->execute();
            $id_calendar=Connection::getInstance()->connect()->lastInsertID('calendar_id_calendar_seq');
            //save at league calendar the id_calendar and the number of the round that will be played at this day
          }
        }
        $i=2;
        foreach($secondHalf as $key => $games){
          $round=$key+1;
          $league_startday=date('Y-m-d',strtotime("+".$i." days",strtotime($league_startday)));
          $w=date('w',strtotime($league_startday));
          switch ($w) {
            case 3:
              $i=2;
              break;
            case '5':
              $i=2;
              break;
            case '0':
              $i=3;
              break;
          }
          if(date('w',strtotime($league_startday))==3 or date('w',strtotime($league_startday))==5 or date('w',strtotime($league_startday))==0){
            echo ($league_startday ."<Br>");
            //save date at calendar with competitiontype
            $query=Connection::getInstance()->connect()->prepare("INSERT INTO calendar (season,id_competition_type,day) values (:season,:id_competition_type,:matchday)");
            $query->bindParam(":season",$season);
            $query->bindParam(":id_competition_type",$id_competition_type);
            $query->bindParam(":matchday",$league_startday);
            $query->execute();
            $id_calendar=Connection::getInstance()->connect()->lastInsertID('calendar_id_calendar_seq');
          }
        }
      }else{
        # TODO: get all season data in the past, verified the positions and make new league tables;
      }

    }
    echo 'Country id ' . $id_country . ' added! Go play :D<br>';
  }
exit;
