<?
require_once('../class/Club.php');
require_once('../class/ClubInfo.php');
class Location{
  public static function getAllLocations(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club_location");
    $query->execute();
    $i=0;
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $location[$i]=$data;
      $location[$i]['clubname']=Club::getClubnameById($data['id_club']);
      $info=ClubInfo::get($data['id_club']);
      $location[$i]['manager']=$info['manager'];
      $location[$i]['logo']=$info['logo'];
      $i++;
    }
    return $location;
  }
  public static function insertLocation($id_club,$lat,$lng){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO club_location (id_club,latitude,longitude) values (:id_club,:lat,:lng)");
    $query->bindParam(":id_club",$id_club);
    $query->bindParam(":lat",$lat);
    $query->bindParam(":lng",$lng);

    $query->execute();
  }
}
