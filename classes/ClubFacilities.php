<?

class ClubFacilities{
  public $club;
  public $tg;
  public $yd;
  public $medical;
  public $physio;
  public $parking;
  public $toilets;
  public $hotdog;
  public $store;
  public $restaurant;
  public $marketing;
  public $lights;
  public $draining;
  public $cover;
  public $sprinklers;
  public $heating;

  public function __construct(Club $club){
    $this->club = $club;
  }

  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_facilities where id_club=:id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    $this->tg = $data->traininggrounds;
    $this->yd = $data->youthacademy;
    $this->medical = $data->medicalcenter;
    $this->physio = $data->physio;
    $this->parking = $data->parking;
    $this->toilets = $data->toilets;
    $this->hotdog = $data->hotdogs;
    $this->store = $data->merchandisestore;
    $this->restaurant = $data->restaurant;
    $this->marketing = $data->marketing;

    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM club_stadium where id_club=:id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_OBJ);

    $this->lights = $data->floodlights;
    $this->draining = $data->draining;
    $this->cover = $data->pitchcover;
    $this->sprinklers = $data->sprinklers;
    $this->heating = $data->heating;
  }
}
