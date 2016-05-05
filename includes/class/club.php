<?

class Club{
	public $club_id;
	protected $account_id;
	protected $country;
	protected $club_name;
	public $country;
	public $refeer_id;
	public function Club($club=0){
		$this->club_id=$club;
	}

	public function getClubName(){
		
	}
	public function getClubCountry(){
		
	}
}

class CreateClub{
	public $club_id;
	protected $account_id;
	protected $country;
	protected $club_name;
	public $country;
	public $refeer_id;

	
	public function CreateClub($id){
		$this->id_acccount=$id;
		$club->setClubCountry();
		$club->setClubName();
		$club->setClubRefeer();
		$club->setClubDefaultData();
		$club->CreateClub();
	}
	public function setClubCountry($c){
		$this->country=$c;
	}
	public function setClubName($n){
		$this->club_name;
	}
	public function setDefaultClubData(){
		
	}
	public function setClubRefeer($r){
		$this->$refeer_id=$r;
	}
	public function MakeClub(){
		
	}
}