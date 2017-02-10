<?

class ClubFans{

  public static function howManyFans($id_club){
    $query=Connection::getInstance()->connect()->prepare("SELECT fans from club_fans where id_club=:id_club");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
		return $data['fans'];
  }
  public static function getFansName($id_club){
    $query=Connection::getInstance()->connect()->prepare("SELECT fansname from club_fans where id_club=:id_club");
    $query->bindParam(':id_club', $id_club);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data['fansname'];
  }
  public static function updateFansName($id_club,$fans){
    $query=Connection::getInstance()->connect()->prepare("UPDATE club_fans set fansname=:fans where id_club=:id_club");
    $query->bindParam(':id_club', $id_club);
    $query->bindParam(':fans',$fans);
    $query->execute();
  }
}
