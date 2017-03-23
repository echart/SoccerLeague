<?


class LeagueFixture{
  public $id_league;
  public $date;

  public function __construct($id_league){
    $this->id_league=$id_league;

    $query = Connection::getInstance()->connect()->prepare("SELECT day from league_calendar where day>=DATE(NOW()) limit 1");
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
  public function __nextMatchesByClub($id_club){
    $query = Connection::getInstance()->connect()->prepare("SELECT * from league_calendar inner join matches using(id_match) where (home=:id_club or away=:id_club) and id_league=:id_league");
    $query->bindParam(':id_league',$this->id_league);
    $query->bindParam(':id_club',$id_club);

    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    return $query;
  }
  public function __nextMatchByClub($id_club){
    $query = Connection::getInstance()->connect()->prepare("SELECT * from league_calendar lc inner join matches using(id_match) where (home=:id_club or away=:id_club) and id_league=:id_league and lc.day >= DATE(now()) limit 1");
    $query->bindParam(':id_league',$this->id_league);
    $query->bindParam(':id_club',$id_club);

    $query->execute();
    $query->setFetchMode(PDO::FETCH_ASSOC);
    return $query;
  }
}
