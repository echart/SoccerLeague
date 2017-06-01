<?
  if($_GET['hash']!='da39a3ee5e6b4b0d3255bfef95601890afd80709'){
    exit;
  }
  include('../classes/Club.php');
  include('../helpers/__dontgetlost.php');
  include('../classes/Competition.php');
  include('../classes/League.php');
  include('../classes/Connection.php');
  include('../classes/GenerateFixture.php');

  error_reporting(E_ALL);
  ini_set('display_errors',1);

  /*----------
  SET COMPETITION DATA
  -----------*/
  $id_competition_type=Competition::getIdCompetitionType('L');
  $teams=18;
  $total_games=($teams*2)-2;
  $league_startday='2017-05-31';
  $league_startday2=2;
  /*-------
  GET SEASON AND + 1(NEXT);
  ---------*/
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
    $official_competition = true;
    $competition = new Competition();
    $competition->__create($season,$id_country,Competition::getIdCompetitionType('L'),$teams,$total_games,$official_competition);
    /*------
    COUNT CLUBS AND COUNT HOW MANY LEAGUES/GROUPS WE NEED TO ADD.
    ------*/
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_country=:id_country");
    $query->bindParam(':id_country',$id_country);
    $query->execute();
    $clubs=$query->rowCount();
    /*------
    IF WE DON'T HAVE 18 CLUBS FOR A GROUP, CREATE MORE AVAILABLE teams
    -------*/
    if(League::leftClubs($clubs)>0){
      for($i=0;$i<League::leftClubs($clubs);$i++){
        Club::__createAvailableTeam($id_country);
      }
    }
    /*------
    RECOUNT CLUBS AND COUNT HOW MANY LEAGUES/GROUPS WE HAVE NOW.
    ------*/
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club where id_country=:id_country");
    $query->bindParam(':id_country',$id_country);
    $query->execute();
    $clubs=$query->rowCount();
    $groups=$clubs/$teams;
    /*------
    ADD league based in groups numbers
    --------*/
    $next=array(1,1); //first (league, group) to be added
    for($i=1;$i<=$groups;$i++){
      /*----
      add league
      -----*/
      $div=$next[0];
      $group=$next[1];
      // $flag=false;
      $league=false;

      // get country name to put it on league_table
      $query=Connection::getInstance()->connect()->prepare("SELECT abbreviation FROM countries where id_country=:id_country");
      $query->bindParam(':id_country',$id_country);
      $query->execute();
      $data=$query->fetch(PDO::FETCH_OBJ);
      $data = file_get_contents('../assets/data/leaguenames/'.strtolower($data->abbreviation).'.json');
      $data = json_decode($data,true);
      //create league
      $league = new League();
      $league->__create($competition->id_competition, $data['data'][0][$div], $div, $group);
      $flag=true;
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
        $leaguetable=$league->__loadtable();
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

            foreach ($games as $arrayTeams) {
             $teams=GenerateFixture::eachTeam($arrayTeams);
             $query=Connection::getInstance()->connect()->prepare("SELECT id_club_stadium FROM club_stadium where id_club=:id_club");
             $query->bindParam(':id_club',$teams[0]);
             $query->execute();
             $data=$query->fetch(PDO::FETCH_OBJ);
             $query=Connection::getInstance()->connect()->prepare("INSERT INTO matches (type,id_location,day,hour,home,away) values ('L',:id_stadium,:matchday,'17:00',:home,:away)");
             $query->bindParam(":matchday",$league_startday);
              $query->bindParam(":id_stadium",$data->id_club_stadium);
             $query->bindParam(":home",$teams[0]);
             $query->bindParam(":away",$teams[1]);
             $query->execute();
             $id_match = Connection::getInstance()->connect()->lastInsertID('matches_id_match_seq');
             $query=Connection::getInstance()->connect()->prepare("INSERT INTO league_calendar (id_league,id_match,day, hour) values (:id_league,:id_match,:matchday, '17:00')");
             $query->bindParam(":id_league",$league->id_league);
             $query->bindParam(":matchday",$league_startday);
              $query->bindParam(":id_match",$id_match);
             $query->execute();
           }
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

            foreach ($games as $arrayTeams) {
             $teams=GenerateFixture::eachTeam($arrayTeams);
             $query=Connection::getInstance()->connect()->prepare("SELECT id_club_stadium FROM club_stadium where id_club=:id_club");
             $query->bindParam(':id_club',$teams[0]);
             $query->execute();
             $data=$query->fetch(PDO::FETCH_OBJ);
             $query=Connection::getInstance()->connect()->prepare("INSERT INTO matches (type,id_location,day,hour,home,away) values ('L',:id_stadium,:matchday,'17:00',:home,:away)");
             $query->bindParam(":matchday",$league_startday);
            $query->bindParam(":id_stadium",$data->id_club_stadium);
             $query->bindParam(":home",$teams[0]);
             $query->bindParam(":away",$teams[1]);
             $query->execute();
             $id_match = Connection::getInstance()->connect()->lastInsertID('matches_id_match_seq');
             $query=Connection::getInstance()->connect()->prepare("INSERT INTO league_calendar (id_league,id_match,day, hour) values (:id_league,:id_match,:matchday, '17:00')");
             $query->bindParam(":id_league",$league->id_league);
             $query->bindParam(":matchday",$league_startday);
              $query->bindParam(":id_match",$id_match);
             $query->execute();
           }
          }
        }
        }else{
        # TODO: get all season data in the past, verified the positions and make new league tables;
      }

    }
    echo 'Country id ' . $id_country . ' added! Go play :D<br>';
  }
exit;
