<?

class Squad{
    public $id_club;
    public $squad;

    public function __construct($id_club){
      $this->id_club=$id_club;
    }
    public function getSquad(){
      $query=Connection::getInstance()->connect()->prepare("SELECT id_player from players where id_club=:id_club");
  		$query->bindParam(':id_club',$id_club);
  		$query->execute();
  		while($data=$query->fetch()){
        $squad[]=$data->id_player;
      }
  		return $squad;
    }
}
