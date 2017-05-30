<?

class MatchStats{
  public $id_matches_stats;
  public $match;
  public $homegoals;
  public $awaygoals;
	public $homepossession;
	public $homefaults;
	public $homesetpieces;
	public $homecorners;
	public $homeshots;
	public $homeshotsontarget;
	public $homeshotsonpost;
	public $homeshotsoutbox;
	public $homespasses;
	public $homepassessuccess;
	public $homeyellowcards;
	public $homeredcards;
	public $homepenalty;
	public $homepenaltysuccess;
	public $awaypossession;
	public $awayfaults;
	public $awaysetpieces;
	public $awaycorners;
	public $awayshots;
	public $awayshotsontarget;
	public $awayshotsonpost;
	public $awayshotsoutbox;
	public $awayyellowcards;
	public $awayredcards;
	public $awaypasses;
	public $awaypassessuccess;
	public $awaypenalty;
	public $awaypenaltysuccess;

  public function __construct(Match $match){
    $this->match = $match;
  }
  public function __create(){
    
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM matches_stats where id_match=:id_match");
    $query->bindParam(':id_match',$this->match->id_match);
    $query->execute();
    $data = $query->fetch();
    $this->homegoals=$data['homegoals'];
    $this->awaygoals = $data['awaygoals'];
  	$this->homepossession = $data['homepossession'];
  	$this->homefaults = $data['homefaults'];
  	$this->homesetpieces = $data['homesetpieces'];
  	$this->homecorners = $data['homecorners'];
  	$this->homeshots = $data['homeshots'];
  	$this->homeshotsontarget = $data['homeshotsontarget'];
  	$this->homeshotsonpost = $data['homeshotsonpost'];
  	$this->homeshotsoutbox = $data['homeshotsoutbox'];
  	$this->homespasses = $data['homespasses'];
  	$this->homepassessuccess = $data['homepassessuccess'];
  	$this->homeyellowcards = $data['homeyellowcards'];
  	$this->homeredcards = $data['homeredcards'];
  	$this->homepenalty = $data['homepenalty'];
  	$this->homepenaltysuccess = $data['homepenaltysuccess'];
  	$this->awaypossession = $data['awaypossession'];
  	$this->awayfaults = $data['awayfaults'];
  	$this->awaysetpieces = $data['awaysetpieces'];
  	$this->awaycorners = $data['awaycorners'];
  	$this->awayshots = $data['awayshots'];
  	$this->awayshotsontarget = $data['awayshotsontarget'];
  	$this->awayshotsonpost = $data['awayshotsonpost'];
  	$this->awayshotsoutbox = $data['awayshotsoutbox'];
  	$this->awayyellowcards = $data['awayyellowcards'];
  	$this->awayredcards = $data['awayredcards'];
  	$this->awaypasses = $data['awaypasses'];
  	$this->awaypassessuccess = $data['awaypassessuccess'];
  	$this->awaypenalty = $data['awaypenalty'];
  	$this->awaypenaltysuccess = $data['awaypenaltysuccess'];
  }
}
