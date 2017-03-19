<?
/**
	* type 'L' = League
	* type 'C' = Cup
  * type 'F' = Friendly League
	* type ='LC' = Liberty League and Champions League
 */
class Competition{
	public $id_competition;
	public $type;
	public $country;
	public $season;
	public $totalclubs;
	public $totalgames;
	public $gamesplayed;
	public $official;

	public function __construct($id_competition=''){
		$this->id_competition = $id_competition;
	}
	public function __load(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * from competition where id_competition=:id_competition");
		$query->bindParam(':id_competition',$this->id_competition);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();

		$this->country=$data->country;
		$this->type=$data->type;
		$this->season=$data->season;
		$this->totalclubs=$data->totalclubs;
		$this->id_competition=$id_competition;
		$this->gamesplayed = $data->gamesplayed;
		$this->official = $data->official;
	}
	public function __create($season, $country, $type, $totalclubs, $totalgames, $official):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO competition(id_competition_type,season,id_country,teams,games,official) values (:id_competition_type,:season,:country,:totalclubs, :totalgames, :official)");
			$query->bindParam(':id_competition_type', $type);
			$query->bindParam(':season',$season);
			$query->bindParam(':country',$country);
			$query->bindParam(':totalclubs',$totalclubs);
			$query->bindParam(':totalgames',$totalgames);
			$query->bindParam(':official',$official);
			$query->execute();
			$this->id_competition = Connection::getInstance()->connect()->lastInsertID('competition_id_competition_seq');
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
			return false;
		}
	}
	public function __delete($id_competition):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("DELETE FROM competition where id_competition=:id_competition");
			$query->bindParam(':id_competition',$this->id_competition);
			$query->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getIdCompetitionType($type){
			$query=Connection::getInstance()->connect()->prepare("SELECT id_competition_type from competition_type where type=:type");
			$query->bindParam(':type',$type);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();

			return $data->id_competition_type;
	}
	public static function getIdCompetition($country){
			$query=Connection::getInstance()->connect()->prepare("SELECT id_competition from competition where id_country=:id_country and official=true");
			$query->bindParam(':id_country',$country);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();

			return $data->id_competition;
	}
}
