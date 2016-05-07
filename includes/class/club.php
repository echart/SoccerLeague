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
	public $con;
	public $club_id;
	
	public function __construct($conn,$id,$c, $cl){
		$this->con=$conn;
		$this->id_account=$id;
		$this->country=$c;
		$this->clubname=$cl;
	}

	public function makeClub():array{
		try{
			$query=pg_query($this->con, "INSERT INTO club (id_country, id_account, clubname) values ('".$this->country."', '".$this->id_account."', '".$this->clubname."') RETURNING id_club");
			$results=pg_fetch_array($query);
			$this->club_id=$results['id_club'];
			$query=pg_query($this->con, "INSERT INTO club_info (id_club) values ('".$this->club_id."')");
			$query=pg_query($this->con, "INSERT INTO club_fans (id_club,fans) values ('".$this->club_id."', '6000')");
			$return=array('return'=>'success');
		}catch(Exception $e){
			$return=array('return','error');
		}
		return $return;
	}
}