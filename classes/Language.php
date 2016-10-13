<?

class Language{

  public static function setLanguage($lang='pt_br'){
    // TODO: save language in database and set language session
  }

  public static function getLanguage(){
    // TODO: select language at db
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
