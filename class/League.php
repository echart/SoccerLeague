<?
/**
 * @author: echart
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
	public $name;

	public function __construct($country, $season, $div, $group){
		try{
			$this->country=$country;
			$this->season=$season;
			$this->div=$div;
			$this->group=$group;
			$query=Connection::getInstance()->connect()->prepare("SELECT id_league,name FROM competition c inner join league l using(id_competition) inner join country ccc on ccc.id_country= c.id_country where c.id_competition_type=1 and c.id_country=:country and l.division=:division and l.divgroup=:group and c.season=:season");
		  $query->bindParam(':country',$this->country);
		  $query->bindParam(':division',$this->div);
		  $query->bindParam(':group',$this->group);
			$query->bindParam(':season',$this->season);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();
			$this->id_league=$data->id_league;
			$this->name=$data->name;
		}catch(PDOException $e){
			echo $e->getmessage();
		}
	}
	public static function createLeague($id_competition,$division, $group, $totalgames){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO league (id_competition, division,divgroup, totalgames, round) values (:id_competition,:division,:group,:totalgames,0)");
			$query->bindParam(':id_competition',$id_competition);
			$query->bindParam(':division',$division);
			$query->bindParam(':group',$group);
			$query->bindParam(':totalgames',$totalgames);
			$query->execute();
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
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
	public function getLeagueTable(){
		$query=Connection::getInstance()->connect()->prepare("SELECT l.round,lt.id_club,cc.clubname,lt.pts, lt.win,lt.loss, lt.draw, lt.goalsp, lt.goalsc FROM league l  inner join league_table lt using(id_league) inner join club cc using(id_club) inner join country ccc on ccc.id_country= cc.id_country where l.id_league=:id_league");
	  $query->bindParam(':id_league',$this->id_league);
	  $query->execute();
	  $query->setFetchMode(PDO::FETCH_ASSOC);
		return $query;
	}
	public static function checkIfLeagueAlreadyExists($season,$country,$div,$group){
		try{
			$query=Connection::getInstance()->connect()->prepare("SELECT id_league FROM competition left join league using(id_competition) where season=:season and id_country=:country and division=:div and divgroup=:group");
			$query->bindParam(':season',$season);
			$query->bindParam(':country',$country);
			$query->bindParam(':div',$div);
			$query->bindParam(':group',$group);
			$query->execute();
			if($query->rowCount()>=1) return true; else return false;
		}catch(PDOException $e){
			echo $e->getmessage();
		}
	}
	public static function lastDivAndGroup($country){
		try{
			$query=Connection::getInstance()->connect()->prepare("select division,divgroup from league inner join competition using(id_competition) where id_country=:id_country order by division,divgroup asc");
			$query->bindParam(':id_country',$country);
			$query->execute();
			$data=$query->fetch(PDO::FETCH_OBJ);
			return array($data->division,$data->divgroup);
		}catch(PDOException $e){
			echo $e->getmessage();
		}
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
	public function joinClub($id_club){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO league_table (id_league,id_club) values (:id_league, :id_club)");
			$query->bindParam(':id_league',$this->id_league);
			$query->bindParam(':id_club',$id_club);
			$query->execute();
		}catch(PDOException $e){
			echo $e->getmessage();
		}
	}
	public function updateRound(){
		// TODO: make script to get all matches, computing pts and update league table
	}
	public static function leftClubs($totalClubs){
		if($totalClubs!=0){
			if(!is_int($totalClubs/18)){
				$leftClubs=intval((ceil($totalClubs/18)-($totalClubs/18))*18);
				return $leftClubs;
			}
		}else{
			return 18;
		}
	}
	public static function getLeagueById($id_league){
		$query=Connection::getInstance()->connect()->prepare("SELECT name, division, divgroup, id_country, abbreviation from league inner join competition using(id_competition) inner join country using(id_country) where id_league=:id_league");
		$query->bindParam(':id_league', $id_league);
		$query->execute();
		$query->setFetchMode(PDO::FETCH_ASSOC);
		$data=$query->fetch();
		return $data;
	}
}
