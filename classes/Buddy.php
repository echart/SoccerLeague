<?

class Buddy{
  public static function makeBuddy($id_club,$id_buddy):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO buddies (buddya,buddyb, status) values(:id_club, :id_buddy,'P')");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      return true;
    }catch(PDOException $e){
      return false;
    }
  }
  public static function getAllBuddies($id_club){

  }
  public static function howManyBuddies($id_club):int{
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddya=:id_club or buddyb=:id_club");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		return $query->rowCount();
  }
  public static function unbuddy($id_club,$id_buddy):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies where buddyb=:id_club and buddya=:id_buddy");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies where buddyb=:id_buddy and buddya=:id_club");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      return true;
    }catch(PDOException $e){
      return false;
    }
  }
  public static function aprovalBuddy($id_club,$id_buddy):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies where buddyb=:id_club and buddya=:id_buddy and status='P'");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO buddies(buddya,buddyb,status) values (:id_club,:id_buddy,'A')");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      return true;
    }catch(PDOException $e){
      return false;
    }
  }
  public static function isPending($buddya,$buddyb){
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddya=:buddya and buddyb=:buddyb and status='P'");
    $query->bindParam(':buddya', $buddya);
    $query->bindParam(':buddyb', $buddyb);
    $query->execute();
    return $query->rowCount();
  }
  public static function isMyFriend($buddya,$buddyb):bool{
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddya=:buddya and buddyb=:buddyb");
    $query->bindParam(':buddya', $buddya);
    $query->bindParam(':buddyb', $buddyb);
    $query->execute();
    if($query->rowCount()> 0){
      return true;
    }else{
      return false;
    }
  }
}
