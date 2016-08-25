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
    $this->date=date('Y-m-d');
  }
  public function getNextLeagueDay(){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_calendar,matchday FROM calendar where matchday>=:matchday and id_competition_type=1 LIMIT 1");
    $query->bindParam(':matchday',$this->date);
    $query->execute();

    $data=$query->fetch(PDO::FETCH_ASSOC);
    $this->next_calendar=$data['id_calendar'];
    $this->next_date=$data['matchday'];
  }
  public function getFixtures(){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_round, round FROM league_calendar where id_calendar=:id_calendar and id_league=:id_league");
    $query->bindParam(':id_calendar',$this->next_calendar);
    $query->bindParam(':id_league',$this->id_league);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    $this->next_round=$data['round'];

    $query=Connection::getInstance()->connect()->prepare("SELECT id_match FROM league_calendar_matches where id_round=:id_round");
    $query->bindParam(':id_round',$data['id_round']);
    $query->execute();
    while($data=$query->fetch(PDO::FETCH_ASSOC)){
      $this->matches[]=$data['id_match'];
    }
    return $this->matches;
  }

  public static function getNextClubFixture($id_club){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM calendar inner join league_calendar using (id_calendar) inner join league_calendar_matches using(id_round) inner join matches using(id_match) where calendar.matchday>now() and (home=:id_club or away=:id_club) limit 1");
    $query->bindParam(":id_club",$id_club);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
  }
}
