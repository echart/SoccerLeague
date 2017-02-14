<?
class Admin{
  public $id_account;
  public $admin;

  public function __construct($id_account){
    $this->id_account=$id_account;
  }

  public function isadmin():bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT type FROM admin where id_account=:id_account");
      $query->bindParam(":id_account",$this->id_account);
      $query->execute();
      if($query->rowCount()>0){
        $data=$query->fetch(PDO::FETCH_ASSOC);
        $this->admin=$data['type'];
        return true;
      }else{
        return false;
      }
    }catch(PDOException $e){
			return false;
			exit;
		}
  }
}
