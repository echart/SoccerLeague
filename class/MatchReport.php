<?

class MatchReport{
  public $id_match;
  public $teams=array('home'=>0,'away'=> 0);
  public function __construct($id_match){
    $this->id_match=$id_match;
  }

  public function teams(){
    $query = Connection::getInstance()->connect()->prepare("SELECT home, away FROM matches where id_match where id_match=:id_match");
    $query->bindParam(':id_match',$this->id_match);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);

    $this->teams['home']=$data['home'];
    $this->teams['away']=$data['away'];

    return $this->teams;
  }
}
