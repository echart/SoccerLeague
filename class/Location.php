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
}
