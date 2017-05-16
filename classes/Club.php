<?
class Club{
  public $id_club;
  public $id_account;
  public $id_country;
  public $clubname;
  public $created;
  public $status;
  public $location;
  public function __construct($id_club=''){
    $this->id_club = $id_club;
  }
  public function __load(){
    $query=Connection::getInstance()->connect()->prepare("SELECT * FROM club left join club_account using(id_club) where id_club=:id_club");
		$query->bindParam(':id_club', $this->id_club);
		$query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);

    $this->id_account = $data['id_account'];
    $this->id_country = $data['id_country'];
    $this->clubname = $data['clubname'];
    $this->created = $data['created'];
    $this->status = $data['status'];
  }
  public function __create(){
    try{
      $date = date('Y-m-d');
      $query=Connection::getInstance()->connect()->prepare("UPDATE club SET clubname=:clubname, status='A', created = '$date' where id_club=:id_club");
      $query->bindParam(':clubname', $this->clubname);
      $query->bindParam(':id_club', $this->id_club);
      $query->execute();

      $query=Connection::getInstance()->connect()->prepare("INSERT INTO club_account(id_club,id_account) values (:id_club,:id_account)");
      $query->bindParam(':id_account', $this->id_account);
      $query->bindParam(':id_club', $this->id_club);
      $query->execute();

      return true;
    }catch(Exception $e){
      echo $e->getMessage();
      return false;
    }
  }
  public static function __createAvailableTeam($id_country){
    $query=Connection::getInstance()->connect()->prepare("INSERT INTO club (id_country) values (:id_country)");
		$query->bindParam(':id_country',$id_country);
		$query->execute();
		return Connection::getInstance()->connect()->lastInsertID('club_id_club_seq');
  }
  public function checkAvailableClub(){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_club from club where status='P' and id_country=:country LIMIT 1");
		$query->bindParam(':country', $this->id_country);
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
  public static function validClubName($club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_club FROM club where clubname=:clubname");
		$query->bindParam(':clubname',$club);
		$query->execute();

		if($query->rowCount()>0) return false; else return true;
	}
	public function lastLogin(){
		$query=Connection::getInstance()->connect()->prepare("SELECT CAST(startdate AS DATE) from session where id_account=:id_account ORDER BY id_session DESC LIMIT 1");
		$query->bindParam(':id_account', $this->id_account);
		$query->execute();
		if($query->rowCount()>0){
			$data=$query->fetch(PDO::FETCH_ASSOC);
			return $data['startdate'];
		}else{
			return false;
		}
	}
	public static function getClubNameById($id_club){
		$query=Connection::getInstance()->connect()->prepare("SELECT clubname from club where id_club=:id_club LIMIT 1");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		return $data->clubname;
	}
	public static function getClubCountryById($id_club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_country from club where id_club=:id_club LIMIT 1");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		return $data['id_country'];
	}
  public static function getClubIDLeague($id_club){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_league from competition inner join league using(id_competition) inner join league_table using(id_league) where id_club=:id_club and season=1 and id_competition_type=1");
		$query->bindParam(':id_club', $id_club);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$data=$query->fetch();
		return $data['id_league'];
	}
  public static function getClubByAccountId($id_account){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_club from club_account where id_account=:id_account LIMIT 1");
    $query->bindParam(':id_account', $id_account, PDO::PARAM_INT);
    $query->execute();
    $query->setFetchMode(PDO::FETCH_OBJ);
    $data=$query->fetch();
    return $data->id_club;
  }
}
