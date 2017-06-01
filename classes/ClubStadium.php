<?

class ClubStadium{
  public $club;
  public $name;
  public $capacity;

  public function __construct(Club $club){
      $this->club = $club;
  }
  public function capacity(){
    $query = Connection::getInstance()->connect()->prepare("SELECT capacity FROM club_stadium WHERE id_club = :id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->capacity = $data->capacity;
    return $this->capacity;
  }
  public function name(){
    $query = Connection::getInstance()->connect()->prepare("SELECT stadium FROM club_info WHERE id_club = :id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);
    $this->name = $data->stadium;
    if($this->name == null) $this->name = 'Estádio Soccer League';
    return $this->name;
  }

  public function construction($new_capacity){
    $capacity = $this->capacity();
    $new_capacity_value = ($new_capacity - $capacity)*250;
    $finances = new ClubFinances($this->club);
    if($new_capacity>0){
      $finances->addConstruction($new_capacity_value);
    }
    $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium set capacity=:new_capacity where id_club=:id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->bindParam(':new_capacity',$new_capacity);
    $query->execute();
  }
}
