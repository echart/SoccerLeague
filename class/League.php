<?
include('Connection.php');
/**
 * createLeague
 * deleteLeague
 * checkIfLeagueAlreadyExists
 * nextAvailableDivAndGroup
 * joinClub();
 * eachRowLeagueTable();
 */
class League{
	public $id_league;
	public $division;
	public $group;
	public $totalgames;
	public $round;

	public function __construct($country, $season, $div, $group){
		$this->country=$country;
		$this->season=$season;
		$this->div=$div;
		$this->group=$group;
		$query=Connection::getInstance()->connect()->prepare("SELECT id_league FROM competition c inner join league l using(id_competition) inner join country ccc on ccc.id_country= c.id_country where c.id_competition_type=1 and c.id_country=:country and l.division=:division and l.divgroup=:group and c.season=:season");
	  $query->bindParam(':country',$this->country);
	  $query->bindParam(':division',$this->div);
	  $query->bindParam(':group',$this->group);
		$query->bindParam(':season',$this->season);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
		$this->id_league=$data->id_league;
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
	public function deleteLeague($id_league):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("DELETE FROM league where id_league:id_league");
			$query->bindParam(':id_league',$id_league);
			$query->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public function eachRowLeagueTable(){
		$query=Connection::getInstance()->connect()->prepare("SELECT cc.clubname,lt.pts, lt.win,lt.loss, lt.draw, lt.goalsp, lt.goalsc FROM league l using(id_competition) inner join league_table lt using(id_league) inner join club cc using(id_club) inner join country ccc on ccc.id_country= c.id_country where l.id_league=:id_league");
	  $query->bindParam(':id_league',$this->id_league);
	  $query->execute();
	  $query->setFetchMode(PDO::FETCH_OBJ);
	}
	public static function checkIfLeagueAlreadyExists($season,$country,$div,$group){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM competition inner join league using(id_competition) where season=:season and country=:country and division:div and divgroup:group");
		$query->bindParam(':season',$season);
		$query->bindParam(':country',$country);
		$query->bindParam(':div',$div);
		$query->bindParam(':group',$group);
		$query->execute();
		if($query->rowCount()>0) return true; else return false;
	}
	public static function lastDivAndGroup(){
		//select division,divgroup from league order by division,divgroup asc
		$query=Connection::getInstance()->connect()->prepare("select division,divgroup from league order by division,divgroup asc")->execute();
		$query->setFetchMode(PDO::FETCH_OBJ);
		$data=$query->fetch();
		return array($data->division,$data->divgroup);
	}
	public function nextAvailableDivAndGroup(){
		if($this->div==1){
			return array($this->div+1,1);
		}else if($this->group<(($this->div-1)*2)){
			return array($this->div,$this->group+1);
		}else if($this->group==(($this->div-1)*2)){
			return array($this->div+1,1);
		}
	}
	public function joinClub($id_club){}
	public function updateRound(){}
}
