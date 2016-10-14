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

  }
  public function __update(){

  }
}
