<?

class PRO{
  public static function amountPRO($id_account){
    $query = Connection::getInstance()->connect()->prepare("SELECT slvip FROM account_data where id_account=:id_account");
    $query->bindParam(':id_account',$id_account);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data['slvip'];
  }
  public static function updatePRO($id_account,$pro){
    $query = Connection::getInstance()->connect()->prepare("UPDATE account_data SET slvip = ':pro' where id_account=:id_account");
    $query->bindParam(':id_account',$id_account);
    $query->bindParam(':pro',$pro);
    $query->execute();
  }
  public static function is_pro($id_club){
    $query = Connection::getInstance()->connect()->prepare("SELECT id_account FROM club inner join club_account using(id_club) inner join account_data using(id_account) where id_club=:id_club and slvip > 0");
    $query->bindParam(':id_club',$id_club);
    $query->execute();
    if($query->rowCount()>0) return true; else return false;
  }
}
