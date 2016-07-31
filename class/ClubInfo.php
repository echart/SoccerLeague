<?

class ClubInfo{
  public static function get($id_club){
    $query=Connection::getInstance()->connect()->prepare("SELECT * from club_info where id_club=:id_club LIMIT 1");
    $query->bindParam(':id_club', $id_club);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public static function set($id_club){
    // TODO: salvar club info
  }
}
