<?

class Buddy{
  public static function makeBuddy($id_club,$id_buddy){

  }
  public static function getAllBuddies($id_club){

  }
  public static function howManyBuddies($id_club){
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddy1=:id_club or buddy2=:id_club");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		return $query->rowCount();
  }
  public static function unbuddy($id_club,$id_buddy){

  }
}
