<?


class LeagueFixture{
  public $id_league;
  public $date;
  public $next_date;
  public $next_idcalendar;
  public $next_round;
  public $matches=array();

  public function __construct($id_league){
    $this->id_league=$id_league;

    $query = Connection::getInstance()->connect()->prepare("select day from league_calendar where day>=DATE(NOW()) limit 1");
    $query->execute();
    $data=$query->fetch(PDO::FETCH_OBJ);
    $this->date = $data->day;
  }
  public function __nextMatches(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM league_calendar where day=:day");
    $query->bindParam(':day',$this->date);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    return $query;
  }
}
