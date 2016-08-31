<!-- #!/usr/local/bin/php -q -->
<?
require_once('../class/Connection.php');
require_once('../class/LeagueTable.php');
$day='2016-08-24';
$day=date('Y-m-d');
$query = Connection::getInstance()->connect()->prepare("SELECT id_calendar,c.id_competition_type FROM league_calendar inner join league using(id_league) inner join competition c using(id_competition) inner join calendar using(id_calendar) where c.id_competition_type=:id_competition_type and matchday=:day");
$query->bindParam(":day",$day);
$query->bindValue(":id_competition_type",1);
$query->execute();

if($query->rowCount()>0){
  $data=$query->fetch(PDO::FETCH_ASSOC);
  $id_competition_type=$data['id_competition_type'];
  $id_calendar=$data['id_calendar'];
  switch ($id_competition_type) {
    case 1:
      $query = Connection::getInstance()->connect()->prepare("SELECT id_round,id_league FROM league_calendar inner join league using(id_league) inner join competition using(id_competition) where id_competition_type=:id_competition_type and id_calendar=:id_calendar");
      $query->bindParam(":id_competition_type",$id_competition_type);
      $query->bindParam(":id_calendar",$id_calendar);

      $query->execute();
      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $id_league=$data['id_league'];
        $id_round=$data['id_round'];
        $query1 = Connection::getInstance()->connect()->prepare("SELECT id_match FROM league_calendar_matches where id_round=:id_round");
        $query1->bindParam(':id_round',$id_round);
        $query1->execute();

        $leagueupdate =  new LeagueTable($id_league);
        while($matches=$query1->fetch(PDO::FETCH_ASSOC)){
          $home=rand(0,3);
          $away=rand(0,3);
          $query2 = Connection::getInstance()->connect()->prepare("UPDATE matches SET homeGoals=:hg, awayGoals=:ag where id_match=:id_match");
          $query2->bindParam(':id_match',$matches['id_match']);
          $query2->bindParam(":ag",$away);
          $query2->bindParam(':hg',$home);
          $query2->execute();
          $leagueupdate->addMatch($matches['id_match']);
          $leagueupdate->addMatchResult($home,$away);
        }
        $leagueupdate->updateLeagueTable();
      }
      break;
  }
}
