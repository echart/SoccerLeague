<?
class Admin{
  public $id_account;
  public $admin;

  public function __construct($id_account){
    $this->id_account=$id_account;
  }

  public function is_admin():bool{
    try{
      $query=Connection::getInstance()->connect()->prepare("SELECT permission FROM account_permission where id_account=:id_account");
      $query->bindParam(":id_account",$this->id_account);
      $query->execute();
      if($query->rowCount()>0){
        $this->admin = array();
        while($data=$query->fetch(PDO::FETCH_ASSOC)){
          $this->admin[] = $data['permission'];
        }
        return true;
      }else{
        return false;
      }
    }catch(PDOException $e){
			return false;
			exit;
		}
  }
  public function is_GT():bool{
    $query=Connection::getInstance()->connect()->prepare("SELECT permission FROM account_permission where id_account=:id_account and permission='GT'");
    $query->bindParam(":id_account",$this->id_account);
    $query->execute();
    if($query->rowCount()>0){
      return true;
    }else{
      return false;
    }
  }
}
