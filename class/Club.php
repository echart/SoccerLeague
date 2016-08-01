<?

class Club{
	public $id_club;
	public $id_account;
	private $con;
	public $clubname;
	public $country;
	public $createdate;
	public $status;

	public function __construct($club=''){
		$this->id_club=$club;
		$this->con=Connection::getInstance()->connect();

		if($club!=''){
			$this->id_club=$club;
			$query=Connection::getInstance()->connect()->prepare("SELECT * from club where id_club=:id_club LIMIT 1");
			$query->bindParam(':id_club', $this->id_club);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_OBJ);
			$this->clubname=$data->clubname;
			$this->club_nickname=$data->nickname;
			$this->createdate=$data->createdate;
			$this->status=$data->status;
			$this->country=$data->id_country;
		}
	}
	public static function getClubNameById($id_club){
		$query=Connection::getInstance()->connect()->prepare("SELECT clubname from club where id_club=:id_club LIMIT 1");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		return $data->clubname;
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
				 Club::createAvailableTeam($this->country);
				 $this->id_club=$this->checkAvailableClub();
			}
			$query=$this->con->prepare("UPDATE club SET clubname=:clubname, status='A' where id_club=:id_club");
			$query->bindParam(':clubname', $this->clubname);
			$query->bindParam(':id_club', $this->id_club);
			$query->execute();

			$query=$this->con->prepare("INSERT INTO club_account (id_club, id_account) values (:id_club,:id_account)");
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
			throw new Exception($e->getmessage(),1);

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
	public static function getClubByAccountId($id_account){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_club from club_account where id_account=:id_account LIMIT 1");
		$query->bindParam(':id_account', $id_account, PDO::PARAM_INT);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
		return $data->id_club;
	}
	public static function createAvailableTeam($id_country){
		$query=Connection::getInstance()->connect()->prepare("INSERT INTO club (id_country,clubname, status) values (:id_country, 'Available Team', 'P')");
		$query->bindParam(':id_country',$id_country);
		$query->execute();
		return Connection::getInstance()->connect()->lastInsertID('club_id_club_seq');
	}
	public static function getClubLeague($id_club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_league from competition inner join league using(id_competition) inner join league_table using(id_league) where id_club=:id_club and season=1 and id_competition_type=1");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$data=$query->fetch();
		return $data['id_league'];
	}
}
