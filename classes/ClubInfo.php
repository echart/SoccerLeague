<?
class ClubInfo{
  public $club;
  public $manager;
  public $nickname;
  public $stadium;
  public $fansname;
  public $logo;
  public $primaryColor;
  public $secondaryColor;
  public $history;
  public function __construct(Club $club){
    $this->club=$club;
  }
  public function __load(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club_info where id_club=:id_club");
		$query->bindParam(':id_club', $this->club->id_club);
		$query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);

    $this->nickname = $data['nickname'];
    $this->manager = $data['manager'];
    $this->stadium = $data['stadium'];
    $this->fansname = $data['fansname'];
    $this->history = $data['history'];
    $this->logo = $this->__logo();
  }
  public function __update(){
  }
  public function __logo(){
    if(PRO::is_pro($this->club->id_club)==true){
      $query=Connection::getInstance()->connect()->prepare("SELECT logo FROM club_info where id_club=:id_club");
  		$query->bindParam(':id_club', $this->club->id_club);
  		$query->execute();
      $data=$query->fetch(PDO::FETCH_ASSOC);
      if($data['logo']==null){
        $this->logo = 'default.png';
      }else{
        $this->logo = $data['logo'];
      }
    }else{
      $this->logo = 'default.png';
    }
    return $this->logo;
  }
}
