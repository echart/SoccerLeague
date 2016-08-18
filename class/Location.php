<?

class Location{
  public static function getAllLocations(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club_location");
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_ASSOC)){$location[]=$data;}
    return $location;
  }
}
