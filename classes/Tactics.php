<?

class Tactics{
  public $club;

  public function __construct(Club $club){
    $this->club = $club;
  }
  public function __save($players_on_field,$players_on_reserve,$functions,$styles, $conditional_orders){
    try{
      $query = Connection::getInstance()->connect()->prepare("SELECT id_tactics FROM tactics where id_club=:id_club");
      $query->bindParam(':id_club',$this->club->id_club);
      $query->execute();
      if($query->rowCount()>0){
        $captain = 0;
        $freekick = 0;
        $corner = 0;
        $penalty = 0;
        $mentality = 0;
        $attackstyle = 0;

        try{
          $query = Connection::getInstance()->connect()->prepare('UPDATE tactics SET players_on_field=:players_on_field, players_on_reserve=:players_on_reserve, captain=:captain,corner=:corner,freekick=:freekick,mentality=:mentality,attackstyle=:attackstyle,penalty=:penalty where id_club=:id_club');
          $query->bindParam(':id_club',$this->club->id_club);
          $query->bindParam(':players_on_field',$players_on_field);
          $query->bindParam(':players_on_reserve',$players_on_reserve);
          $query->bindParam(':captain',$captain);
          $query->bindParam(':corner',$corner);
          $query->bindParam(':freekick',$freekick);
          $query->bindParam(':penalty',$penalty);
          $query->bindParam(':mentality',$mentality);
          $query->bindParam(':attackstyle',$attackstyle);
          $query->execute();
        }catch(PDOException $e){
          echo $e->getMessage();
        }
      }else{
        $query = Connection::getInstance()->connect()->prepare("INSERT INTO tactics(id_club, players_on_field, players_on_reserve, captain, corner, freekick, penalty, mentality, attackstyle) VALUES (:id_club, :players_on_field, :players_on_reserve, :captain, :corner, :freekick, :penalty, :mentality, :attackstyle)");
        $query->bindParam(':id_club',$this->club->id_club);
        $query->bindParam(':players_on_field',$players_on_field);
        $query->bindParam(':players_on_reserve',$players_on_reserve);
        $query->bindParam(':captain',$captain);
        $query->bindParam(':corner',$corner);
        $query->bindParam(':freekick',$freekick);
        $query->bindParam(':penalty',$penalty);
        $query->bindParam(':mentality',$mentality);
        $query->bindParam(':attackstyle',$attackstyle);
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
