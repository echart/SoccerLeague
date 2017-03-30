<?
/**
 * @author: Echart
 * This class will handle all last visits stuff in site. Like when a club visit each other, we will know.
 */
class Visits{
  /*
    IF visit is a club = C
    IF visit is a forum topic = F
  */
  public static function addVisit($visitor,$visited):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO club_visits(id_club,id_club_visited, visitdate) values (:id_visitor,:id_visited,now())");
      $query->bindParam(':id_visitor',$visitor);
      $query->bindParam(':id_visited',$visited);
      $query->execute();
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }
  public static function getLastVisitors($visited){
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club_visits where id_club_visited=:visited group by id_club limit 10");
      $query->bindParam(':visited',$visited);
      $query->execute();
      $i=0;
      $visitors;
      if($query->rowCount()>0){
        while($data=$query->fetch(PDO::FETCH_ASSOC)){
          $visitors[$i]=$data['id_club'];
          $i++;
        }
        return $visitors;
      }
    }catch(PDOException $e){
      echo $e->getmessage();
    }
  }
  public static function howManyClubsVisitMe($visited){
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club_visits where id_club_visited=:visited group by id_club");
      $query->bindParam(':visited',$visited);
      $query->execute();
      return $query->rowCount();
    }catch(PDOException $e){echo $e->getmessage(); return 0;}
  }
}
