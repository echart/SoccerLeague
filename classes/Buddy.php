<?

class Buddy{
  public static function makeBuddy($id_club,$id_buddy):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO buddies_pending (buddy1,buddy2) values(:id_club, :id_buddy)");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      return true;
    }catch(PDOException $e){
      return false;
    }
  }
  public static function unMakeBuddy($id_club,$id_buddy){
    try{
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies_pending where buddy1=:id_club and buddy2=:id_buddy");
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
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddy1=:id_club or buddy2=:id_club");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		return $query->rowCount();
  }
  public static function unbuddy($id_club,$id_buddy):bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies where buddy2=:id_club and buddy1=:id_buddy");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies where buddy2=:id_buddy and buddy1=:id_club");
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
      $query=Connection::getInstance()->connect()->prepare("DELETE FROM buddies_pending where buddy2=:id_club and buddy1=:id_buddy");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      $query=Connection::getInstance()->connect()->prepare("INSERT INTO buddies(buddy1,buddy2,since) values (:id_club,:id_buddy,'".date('Y-m-d')."')");
      $query->bindParam(':id_club', $id_club);
      $query->bindParam(':id_buddy', $id_buddy);
      $query->execute();
      return true;
    }catch(PDOException $e){
      return false;
    }
  }
  public static function isPending($buddy1,$buddy2){
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies_pending where buddy1=:buddy1 and buddy2=:buddy2");
    $query->bindParam(':buddy1', $buddy1);
    $query->bindParam(':buddy2', $buddy2);
    $query->execute();
    return $query->rowCount();
  }
  public static function isMyFriend($buddy1,$buddy2):bool{
    $query=Connection::getInstance()->connect()->prepare("SELECT * from buddies_pending where buddy1=:buddy1 and buddy2=:buddy2");
    $query->bindParam(':buddy1', $buddy1);
    $query->bindParam(':buddy2', $buddy2);
    $query->execute();
    $query1=Connection::getInstance()->connect()->prepare("SELECT * from buddies where buddy1=:buddy2 and buddy2=:buddy1");
    $query1->bindParam(':buddy1', $buddy1);
    $query1->bindParam(':buddy2', $buddy2);
    $query1->execute();
    if($query->rowCount()> 0 OR $query1->rowCount()>0){
      return true;
    }else{
      return false;
    }
  }
}
