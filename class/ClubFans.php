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
}
