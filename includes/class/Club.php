<?

class Club{
	public $club_id;
	protected $account_id;
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
	protected $account_id;
	protected $clubname;
	public $country;
	public $club_id;
	
	public function __construct($id,$c, $cl){
		$this->id_account=$id;
		$this->country=$c;
		$this->clubname=$cl;
	}

	public function create():array{
		try{
			$query=Connection::connect()->prepare("INSERT INTO club (id_country, id_account, clubname) values (:country, :id_account,:clubname)");
			$query->bindParam(':country', $this->country);
			$query->bindParam(':id_account', $this->id_account);
			$query->bindParam(':clubname', $this->clubname);
			$query->execute();
			
			$this->club_id=Connection::connect()->lastInsertID();

			$query=Connection::connect()->prepare("INSERT INTO club_info (id_club) values (:id_club)");
			$query->bindParam(':id_club',$this->club_id);
			$query->execute();

			$query=Connection::connect()->prepare("INSERT INTO club_fans (id_club,fans) values (:id_club, '6000')");
			$query->bindParam(':id_club',$this->club_id);
			$query->execute();


			$return=array('return'=>'success');
		}catch(Exception $e){
			$return=array('return','error');
		}
		return $return;
	}
}