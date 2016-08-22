<?

class Language{
  public function getLanguages(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM language");
    $query->execute();
    $languages=array();
    while ($data=$query->fetch(PDO::FETCH_ASSOC)){
      $languages[]=$data;
    }
    return $languages;
  }
}
