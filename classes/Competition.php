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
	public $name;
	public $season;
	public $totalclubs;

	public function __construct($id_competition){
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
	}
	public static function createCompetition($season, $country, $type, $totalclubs):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO competition(id_competition_type,season, id_country,totalclubs) values (:id_competition_type,:season,:country,:totalclubs)");
			$query->bindParam(':id_competition_type', $type);
			$query->bindParam(':season',$season);
			$query->bindParam(':country',$country);
			$query->bindParam(':totalclubs',$totalclubs);

			$query->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
			return false;
		}
	}
	public static function deleteCompetition($id_competition):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("DELETE FROM competition where id_competition=:id_competition");
			$query->bindParam(':id_competition',$id_competition);
			$query->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public static function getIdCompetitionType($type){
			$query=Connection::getInstance()->connect()->prepare("SELECT id_competition_type from competition_types where type=:type");
			$query->bindParam(':type',$type);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();

			return $data->id_competition_type;
	}
	public static function getIdCompetition($type,$country, $season){
		$query=Connection::getInstance()->connect()->prepare("SELECT id_competition from competition where season=:season and id_country=:country and id_competition_type=:type");
		$query->bindParam(':type',$type);
		$query->bindParam(':season',$season);
		$query->bindParam(':country',$country);
		$query->execute();

		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();

		return $data->id_competition;
	}
}
