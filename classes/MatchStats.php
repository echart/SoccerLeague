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
  public function __createWO(){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO matches_stats (id_match, homegoals, awaygoals) values
            (:id_match, :homegoals, :awaygoals)");
    $query->bindValue(':id_match',$this->match->id_match);
    $query->bindValue(':homegoals',$this->homegoals);
    $query->bindValue(':awaygoals',$this->awaygoals);
    $query->execute();
  }
  public function __create(){
    $query = Connection::getInstance()->connect()->prepare("INSERT INTO matches_stats (id_match, homegoals, awaygoals, homepossession,
            homefaults, homesetpieces, homecorners, homeshots, homeshotsontarget,
            homeshotsonpost, homeshotsoutbox, homespasses, homepassessuccess,
            homeyellowcards, homeredcards, homepenalty, homepenaltysuccess,
            awaypossession, awayfaults, awaysetpieces, awaycorners, awayshots,
            awayshotsontarget, awayshotsonpost, awayshotsoutbox, awayyellowcards,
            awayredcards, awaypasses, awaypassessuccess, awaypenalty, awaypenaltysuccess) values
            (:id_match, :homegoals, :awaygoals, :homepossession,
            :homefaults, :homesetpieces, :homecorners, :homeshots, :homeshotsontarget,
            :homeshotsonpost, :homeshotsoutbox, homespasses, homepassessuccess,
            :homeyellowcards, :homeredcards, :homepenalty, :homepenaltysuccess,
            :awaypossession, :awayfaults, :awaysetpieces, :awaycorners, :awayshots,
            :awayshotsontarget, :awayshotsonpost, :awayshotsoutbox, :awayyellowcards,
            :awayredcards, :awaypasses, :awaypassessuccess, :awaypenalty, :awaypenaltysuccess)");
    $query->bindValue(':id_match',$this->match->id_match);
    $query->bindValue(':homegoals',$this->homegoals);
    $query->bindValue(':awaygoals',$this->awaygoals);
  	$query->bindValue(':homepossession',$this->homepossession);
  	$query->bindValue(':homefaults',$this->homefaults);
  	$query->bindValue(':homesetpieces',$this->homesetpieces);
  	$query->bindValue(':homecorners',$this->homecorners);
  	$query->bindValue(':homeshots',$this->homeshots);
  	$query->bindValue(':homeshotsontarget',$this->homeshotsontarget);
  	$query->bindValue(':homeshotsonpost',$this->homeshotsonpost);
  	$query->bindValue(':homeshotsoutbox',$this->homeshotsoutbox);
  	$query->bindValue(':homespasses',$this->homespasses);
  	$query->bindValue(':homepassessuccess',$this->homepassessuccess);
  	$query->bindValue(':homeyellowcards',$this->homeyellowcards);
  	$query->bindValue(':homeredcards',$this->homeredcards);
  	$query->bindValue(':homepenalty',$this->homepenalty);
  	$query->bindValue(':homepenaltysuccess',$this->homepenaltysuccess);
  	$query->bindValue(':awaypossession',$this->awaypossession);
  	$query->bindValue(':awayfaults',$this->awayfaults);
  	$query->bindValue(':awaysetpiece',$this->awaysetpiece);
  	$query->bindValue(':awaycorners',$this->awaycorners);
  	$query->bindValue(':awayshots',$this->awayshots);
  	$query->bindValue(':awayshotsontarget',$this->awayshotsontarget);
  	$query->bindValue(':awayshotsonpost',$this->awayshotsonpost);
  	$query->bindValue(':awayshotsoutbox',$this->awayshotsoutbox);
  	$query->bindValue(':awayyellowcards',$this->awayyellowcards);
  	$query->bindValue(':awayredcards',$this->awayredcards);
  	$query->bindValue(':awaypasses',$this->awaypasses);
  	$query->bindValue(':awaypassessuccess',$this->awaypassessuccess);
  	$query->bindValue(':awaypenalty',$this->awaypenalty);
  	$query->bindValue(':awaypenaltysuccess',$this->awaypenaltysuccess);
    $query->execute();
    $query->debugDumpValues();
  }
  public function __load(){
    $query = Connection::getInstance()->connect()->prepare("SELECT * FROM matches_stats where id_match=:id_match");
    $query->bindValue(':id_match',$this->match->id_match);
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
