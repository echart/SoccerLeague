<?

class Club{
	public $id_club;
	protected $id_account;
	private $con;

	protected $clubname;
	protected $club_nickname;
	public $country;


	public function __construct($club=''){
		$this->id_club=$club;
		$this->con=Connection::getInstance()->connect();
		
		if($club!=''){
			$this->id_club=$club;
		}
	}
	public function getClub($id){
		if($id==''){
			return new self($_SESSION['id_club']);
		}else{
			return new self($id);
		}
	}

	public function setClubName($name){
		$this->clubname=$name;
	}
	public function getClubName(){
		return $this->clubname;
	}
	public function setCountry($country){
		$this->country=$country;
	}
	public function getCountry(){
		return $this->country;
	}


	public function create():bool{
		try{
			$query=$this->con->prepare("INSERT INTO club (id_country, id_account, clubname) values (:country, :id_account,:clubname)");
			$query->bindParam(':country', $this->country);
			$query->bindParam(':id_account', $this->id_account);
			$query->bindParam(':clubname', $this->clubname);
			$query->execute();
			$this->id_club=$this->con->lastInsertID();

			$query=$this->con->prepare("INSERT INTO club_info (id_club) values (:id_club)");
			$query->bindParam(':id_club',$this->id_club);
			$query->execute();

			$query=$this->con->prepare("INSERT INTO club_fans (id_club,fans) values (:id_club, '6000')");
			$query->bindParam(':id_club',$this->id_club);
			$query->execute();

			$return=array('return'=>'success');
		}catch(Exception $e){
			$return=array('return','error');
		}catch(PDOException $e){
			$return=array('return','error');
		}
		
		return $return;
	}
	
	public function delete():bool{

	}

	public static function validClubName($club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where clubname=:clubname");
		$query->bindParam(':clubname',$email);
		$query->execute();

		if($query->rowCount()>0) return false; else return true;
	}
}