<?
  include('../class/Connection.php');
  include('../class/League.php');
  /*----------
  SET COMPETITION DATA
  -----------*/
  $competition_type='L';
  $query=Connection::getInstance()->connect()->query("SELECT id_competition FROM competition where type=:type");
  $query->bindParam(':type',$competition_type);
  $query->execute();
  $data=$query->fetch(PDO::FETCH_OBJ);
  $id_competition=$data->
  $teams=18;
  $total_games=($teams*2)-2;
  /*-------
  GET SEASON AND + 1(NEXT);
  ---------*/
  $query=Connection::getInstance()->connect()->query("SELECT season FROM season");
  $query->execute();
  if($query->rowCount()==0){
    $season=1;
  }else{
    $data=$query->fetch(PDO::FETCH_OBJ);
    $season=$data->season+1;
  }
  /*-----
  GET ALL COUNTRIES
  -------*/
  $query=Connection::getInstance()->connect()->query("SELECT id_country FROM country");
  $query->execute();
  $countries=array();
  while($data=$query->fetch(PDO::FETCH_OBJ){
    $countries[]=$data->id_country;
  }
  /*------
  add an competition/league to all countries
  --------*/
  foreach ($countries as $key => $id_country) {
    /*----
    ADD competition
    ------*/
    $query->Connection::getInstance()->connect()->prepare("INSERT INTO competition (id_competition_type, season, id_country, totalclubs) values (:id_competition_type,:season,:id_country,:totalclubs)");
    $query->bindParam(':id_competition_type',$id_competition_type);
    $query->bindParam(':season',$season);
    $query->bindParam(':id_country',$id_country);
    $query->bindParam('totalclubs',$teams);
    $query->execute();
    $id_competition=Connection::getInstance()->connect()->lastInsertID('competition_id_competition_seq');

    /*------
    COUNT CLUBS AND COUNT HOW MANY LEAGUES/GROUPS WE NEED TO ADD.
    ------*/
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM clubs where id_country=:id_country");
    $query->bindParam(':id_country',$id_country);
    $query->execute();
    $clubs=$query->rowCount();
    /*------
    IF WE DONT HAVE 18 CLUBS FOR A GROUP, CREATE MORE AVAILABLE teams
    -------*/
    if(League::leftClubs()>0){
      for($i=0;$i<League::leftClubs();$i++){
        $query=Connection::getInstance()->connect()->prepare("INSERT INTO club (id_country,clubname, status) values (:id_country, 'Available Team', 'P')");
        $query->bindParam(':id_country',$id_country);
        $query->execute();
      }
    }
    $groups=$clubs/$teams;
    /*------
    ADD league based in groups numbers
    --------*/
    for($i=0;$i<$groups;$i++){
      /*----
      add league
      -----*/
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO league (id_competition, name, division, group, totalgames, round) values(:id_competition,:name,:division,:group,:totalgames,0)");
      $query->bindParam(':id_competition',$id_competition);
      $query->bindParam(':name',$name);
      $query->bindParam(':division',$division);
      $query->bindParam(':group',$group);
      $query->bindParam(':totalgames',$total_games);
      $query->execute();
      $id_league=Connection::getInstance()->connect()->lastInsertID('league_id_league_seq');
      /*-----
      add league_table
      ------*/
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO league_table (id_league,id_club)");

    }
  }
