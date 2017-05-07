<?

class ClubFinances{
  public $club;
  public $money;
  public $tickets;
  public $tv;
  public $merchandise;
  public $food;
  public $sponsor;
  public $wage;
  public $constructions;
  public $interests;

  public function __construct(Club $club){
    $this->club = $club;
  }
  public function __wallet(){
    //returns club money
    $query = Connection::getInstance()->connect()->prepare("SELECT money FROM club_finances WHERE id_club = :id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->money = $data->money;
    return $this->money;
  }
  public function week(){
    $query = Connection::getInstance()->connect()->prepare("SELECT money, tickets, tv, merchandise, food, sponsor, wage, constructions, interests, maintenance FROM club_finances WHERE id_club = :id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->money = $data->money;
    $this->tickets = $data->tickets;
    $this->tv = $data->tv;
    $this->merchandise = $data->merchandise;
    $this->food = $data->food;
    $this->sponsor = $data->sponsor;
    $this->wage = $data->wage;
    $this->constructions = $data->constructions;
    $this->maintenance = $data->maintenance;
  }
  public function season(){
    $query = Connection::getInstance()->connect()->prepare("SELECT money, tickets, tv, merchandise, food, sponsor, wage, constructions, interests, maintenance FROM club_finances_season WHERE id_club = :id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->money = $data->money;
    $this->tickets = $data->tickets;
    $this->tv = $data->tv;
    $this->merchandise = $data->merchandise;
    $this->food = $data->food;
    $this->sponsor = $data->sponsor;
    $this->wage = $data->wage;
    $this->constructions = $data->constructions;
    $this->maintenance = $data->maintenance;
  }
}
