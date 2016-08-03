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
  public static function addVisit($visitor,$visited,$type):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO visits(id_visitor,id_visited,visit_type) values (:id_visitor,:id_visited,:visit_type)");
      $query->bindParam(':id_visitor',$id_visitor);
      $query->bindParam(':id_visited',$id_visited);
      $query->bindParam(':visit_type',$visit_type);
      $query->execute();
      return true;
    }catch(PDOException $e){
      echo $e->getmessage();
      return false;
    }
  }
  public static function getLastVisitors($visited, $type){
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT DISTINCT id_visitor FROM visits where id_visited=:visited and visit_type=:type limit 10");
      $query->bindParam(':visited',$visited);
      $query->bindParam(':type',$type);
      $query->execute();
      $i=0;
      while($data=$query->fetch(PDO::FETCH_ASSOC)){
        $data['visitors'][$i]=$data;
        $i++;
      }
      return $data;
    }catch(PDOException $e){
      echo $e->getmessage();
    }
  }
  public static function howManyClubsVisitMe($visited,$type){
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT DISTINCT id_visitor FROM visits where id_visited=:visited and visit_type=:type");
      $query->bindParam(':visited',$visited);
      $query->bindParam(':type',$type);
      $query->execute();
      return $query->rowCount();
    }catch(PDOException $e){echo $e->getmessage(); return 0;}
  }
}
