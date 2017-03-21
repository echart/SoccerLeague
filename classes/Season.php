<?

class Season{
  public $season;
  public $start;
  public $end;

  //return the actual season
  public static function getSeason(){
    $query=Connection::getInstance()->connect()->prepare("SELECT season FROM season WHERE endseason > '" . date('Y-m-d') . "' LIMIT 1");
    $query->execute();
    $query->setFetchMode(PDO::FETCH_OBJ);
    $data=$query->fetch();
    return $data->season;
  }
}
