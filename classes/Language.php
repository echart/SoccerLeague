<?

class Language{
  private $lang;

  public function __construct($lang='BR'){
    $this->lang=$lang;
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
