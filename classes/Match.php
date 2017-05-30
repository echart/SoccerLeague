<?

class Match{
  public $id_match;
  public $type;
  public $id_location;
  public $day;
  public $hour;
  public $id_weather;
  public $pitch;
  public $home;
  public $away;
  public $attendance;

  public function __construct($id_match=''){
    $this->id_match = $id_match;
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM matches where id_match=:id_match");
    $query->bindParam(':id_match',$this->id_match);
    $query->execute();

    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->type = $data->type;
    $this->id_location = $data->id_location;
    $this->day = $this->day;
    $this->hour = $data->hour;
    $this->id_weather = $data->id_weather;
    $this->pitch = $data->pitch;
    $this->home = intval($data->home);
    $this->away = intval($data->away);
    $this->attendance = $data->attendance;

  }
  // public function __create(){
  //
  // }
  public function __update(){

  }
}
