<?

class Tactics{
  public $club;

  public function __construct(Club $club){
    $this->club = $club;
  }
  public function __save($players_on_field,$players_on_reserve,$players_functions,$tactical_data, $conditional_orders){
    try{
      $query = Connection::getInstance()->connect()->prepare("SELECT id_tactics FROM tactics where id_club=:id_club");
      $query->bindParam(':id_club',$this->club->id_club);
      $query->execute();
      if($query->rowCount()>0){
        try{
          $query = Connection::getInstance()->connect()->prepare('UPDATE tactics SET players_on_field=:players_on_field, players_on_reserve=:players_on_reserve, players_functions=:players_functions, tactical_data=:tactical_data where id_club=:id_club');
          $query->bindParam(':id_club',$this->club->id_club);
          $query->bindParam(':players_on_field',$players_on_field);
          $query->bindParam(':players_on_reserve',$players_on_reserve);
          $query->bindParam(':players_functions',$players_functions);
          $query->bindParam(':tactical_data',$tactical_data);
          $query->execute();
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }else{
        $query = Connection::getInstance()->connect()->prepare("INSERT INTO tactics(id_club, players_on_field, players_on_reserve, players_functions,tactical_data) VALUES (:id_club, :players_on_field, :players_on_reserve, :players_functions,:tactical_data)");
        $query->bindParam(':id_club',$this->club->id_club);
        $query->bindParam(':players_on_field',$players_on_field);
        $query->bindParam(':players_on_reserve',$players_on_reserve);
        $query->bindParam(':players_functions',$players_functions);
        $query->bindParam(':tactical_data',$tactical_data);
        $query->execute();
      }
    }catch(PDOException $e){
      return false;
    }finally{
      return true;
    }
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM tactics where id_club=:id_club");
    $query->bindParam(':id_club',$this->club->id_club);
    $query->execute();
    $data = $query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
}
