<?

class Language{
  public $id_account;
  public $lang;

  public function __construct($id_account,$lang='pt_br'){
    $this->id_account=$id_account;
    $this->lang=$lang;
  }

  public function setLanguage(){
    $query = Connection::getInstance()->connect()->prepare("SELECT id_language FROM language where lang=:lang");
    $query->bindParam(":lang",$this->lang);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
    $query = Connection::getInstance()->connect()->prepare("UPDATE account_data SET id_language=:id_language WHERE id_account = :id_account");
    $query->bindParam(":id_language",$id_language);
    $query->bindParam(":id_account",$this->id_account);
    $_SESSION['language']=$this->lang;
  }

  public function getLanguage(){
    $query = Connection::getInstance()->connect()->prepare("SELECT id_language FROM account_data where id_account");
    $query->bindParam(":lang",$this->lang);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
  }

  public static function getLanguages(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM language");
    $query->execute();
    $languages=array();
    while ($data=$query->fetch(PDO::FETCH_ASSOC)){
      $languages[]=$data;
    }
    return $languages;
  }
}
