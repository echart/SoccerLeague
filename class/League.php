<?
include('Competition.php');

class League{
	public $id_league;
	public $division;
	public $group;
	public $totalgames;
	public $round;

	public function __construct($country, $season, $div, $group){
		parent::__construct($country, $season, 'L');
		$query=Connection::getInstance()->connect()->prepare("SELECT * from league where id_league:id_league");
		$query->bindParam(':id_league',$this->id_league);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();

	}
	public static function createLeague($id_competition, $division, $group, $totalgames){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO league (id_competition, division,divgroup, totalgames, round) values (:id_competition,:division,:group,:totalgames,0)");
			$query-bindParam(':id_competition',$id_competition);
			$query-bindParam(':division',$division);
			$query-bindParam(':group',$group);
			$query-bindParam(':totalgames',$totalgames);
			$query->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public static function deleteLeague($id_league):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("DELETE FROM league where id_league:id_league");
			$query->bindParam(':id_league',$id_league);
			$query->execute();
			return true;
		}catch(PDOException $e);
			return false;
		}
	}
	public function getLeagueTable();
	public function updateLeagueTable();
	public static function checkIfLeagueAlreadyExists($season,$country,$div,$group){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM competition inner join league using(id_competition) where season=:season and country=:country and division:div and divgroup:group");
		$query->bindParam(':season',$season);
		$query->bindParam(':country',$country);
		$query->bindParam(':div',$div);
		$query->bindParam(':group',$group);
		$query->execute();
		if($query->rowCount()>0) return true; else return false;
	}
}
