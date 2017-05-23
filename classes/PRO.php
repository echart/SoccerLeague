<?

class PRO{
  public $PRO;

  public static function amountPRO($id_account){

  }
  public static function addPRO($id_account,$qtd){

  }
  public static function removePRO($id_account,$qtd){

  }
  public static function is_pro($id_club){
    $query = Connection::getInstance()->connect()->prepare("SELECT id_account FROM club inner join club_account using(id_club) inner join account_data using(id_account) where id_club=:id_club and slvip > 0");
    $query->bindParam(':id_club',$id_club);
    $query->execute();
    if($query->rowCount()>0) return true; else return false;
  }
}
