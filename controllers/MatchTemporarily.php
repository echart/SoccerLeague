#!/usr/local/bin/php -q
<?
require_once('../class/Connection.php');
$date=date('Y-m-d');

$query = Connection::getInstance()->connect()->prepare("SELECT id_round,id_league FROM league_calendar inner join league using(id_league) inner join competition c using(id_competition) inner join calendar using(id_calendar) where c.id_competition_type=:id_competition_type and matchday=:day");
$query->bindParam(":day",$day);
$query->execute();

if($query->rowCount()>0){
  $data=$query->fetch(PDO::FETCH_ASSOC);
  $id_competition_type=$data['id_competition_type'];
  $id_calendar=$data['id_calendar'];
  switch ($id_competition_type) {
    case 1:
      $query = Connection::getInstance()->connect()->prepare("SELECT id_round,id_league FROM league_calendar inner join league using(id_league) inner join competition using(id_competition) where id_competition_type=:id_competition_type and id_calendar=:id_calendar");
      $query->bindParam(":id_competition_type",$id_competition_type);
      $query->bindParam(":id_competition_type",$id_calendar);

      $query->execute();
      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $id_league=$data['id_league'];
        $id_round=$data['id_round'];
        $query = Connection::getInstance()->connect()->prepare("SELECT id_match FROM league_calendar_matches where id_round=:id_round");
        $query->bindParam(':id_round',$id_round);
        $query->execute();

        while($matches=$query->fetch(PDO::FETCH_ASSOC)){
          
        }
      }
      break;
  }
}
