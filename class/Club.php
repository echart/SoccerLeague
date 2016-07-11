<?

class Club{
	public $id_club;
	public $id_account;
	private $con;
	public $clubname;
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
			$this->id_club=$this->checkAvailableClub();
			if($this->id_club==0){
					throw new PDOException("Error Processing Request", 1);
			}
			$query=$this->con->prepare("UPDATE club SET clubname=:clubname, status='A' where id_club=:id_club");
			$query->bindParam(':clubname', $this->clubname);
			$query->bindParam(':id_club', $this->id_club);
			$query->execute();

			$query=$this->con->prepare("INSERT INTO club_account (id_account,id_club) values (:id_account,:id_club)");
			$query->bindParam(':id_account',$this->id_account);
			$query->bindParam(':id_club',$this->id_club);
			$query->execute();

			$query=$this->con->prepare("INSERT INTO club_info (id_club) values (:id_club)");
			$query->bindParam(':id_club',$this->id_club);
			$query->execute();

			$query=$this->con->prepare("INSERT INTO club_fans (id_club) values (:id_club)");
			$query->bindParam(':id_club',$this->id_club);
			$query->execute();

			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public function delete():bool{}
	public static function validClubName($club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where clubname=:clubname");
		$query->bindParam(':clubname',$club);
		$query->execute();

		if($query->rowCount()>0) return false; else return true;
	}
	public function checkAvailableClub():int{
		$query=Connection::getInstance()->connect()->prepare("SELECT id_club from club where status='P' and id_country=:country LIMIT 1");
		$query->bindParam(':country', $this->country);
		$query->execute();
		if($query->rowCount()>0){
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();
			$this->id_club=$data->id_club;
			return $this->id_club;
		}else{
			return 0;
		}
	}
}
