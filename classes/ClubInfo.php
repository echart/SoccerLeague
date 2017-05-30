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
    return $this;
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
    $this->primaryColor = $data['primarycolor'];
    $this->secondaryColor = $data['secondarycolor'];
    $this->logo = $this->__logo();
  }
  public function __update(){
    $query=Connection::getInstance()->connect()->prepare("UPDATE club_info SET nickname=:nickname,manager=:manager,stadium=:stadium,fansname=:fansname,history=:history,primaryColor=:primaryColor,logo=:logo where id_club=:id_club");
    $query->bindParam(':id_club', $this->club->id_club);
    $query->bindParam(':nickname', $this->nickname);
    $query->bindParam(':manager', $this->manager);
    $query->bindParam(':stadium', $this->stadium);
    $query->bindParam(':fansname', $this->fansname);
    $query->bindParam(':history', $this->history);
    $query->bindParam(':primaryColor', $this->primaryColor);
    $query->bindParam(':logo', $this->logo);
    $query->execute();
  }
  public function __updateClubName(){
    $query=Connection::getInstance()->connect()->prepare("UPDATE club SET clubname=:clubname where id_club=:id_club");
    $query->bindParam(':id_club', $this->club->id_club);
    $query->bindParam(':clubname', $this->club->clubname);
    $query->execute();
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
