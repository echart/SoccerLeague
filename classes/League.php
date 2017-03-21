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
	public $id_competition;
	public $division;
	public $group;
	public $name;

	public function __construct($id_competition='',$div='', $group=''){
		$this->id_competition = $id_competition;
		$this->division = $div;
		$this->group = $group;
	}
	public function __load(){
		try{

			$query = Connection::getInstance()->connect()->prepare("SELECT * FROM league where id_league=:id_league");
			$query->bindParam(':id_league',$this->id_league);
			$query->execute();
			$query->setFetchMode(PDO::FETCH_OBJ);
			$data=$query->fetch();

			$this->id_league=$data->id_league;
			$this->id_competition = $data->id_competition;
			$this->name=$data->leaguename;
			$this->division = $data->division;
			$this->group = $data->divgroup;

		}catch(PDOException $e){
			echo $e->getmessage();
		}
	}
	public function __loadIDleague(){
			try{

				$query = Connection::getInstance()->connect()->prepare("SELECT id_league FROM league inner join competition using(id_competition) where id_competition=:id_competition and division=:division and divgroup=:divgroup");
				$query->bindParam(':id_competition',$this->id_competition);
				$query->bindParam(':division',$this->division);
				$query->bindParam(':divgroup',$this->group);
				$query->execute();
				$query->setFetchMode(PDO::FETCH_OBJ);
				$data=$query->fetch();
				$this->id_league=$data->id_league;
			}catch(PDOException $e){
				echo $e->getmessage();
			}
	}
	public function __create($id_competition, $name, $division, $group){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO league (id_competition, leaguename,division,divgroup) values (:id_competition,:name,:division,:group)");
			$query->bindParam(':id_competition',$id_competition);
			$query->bindParam(':name',$name);
			$query->bindParam(':division',$division);
			$query->bindParam(':group',$group);
			$query->execute();
			$this->id_league = Connection::getInstance()->connect()->lastInsertID('league_id_league_seq');
			return true;
		}catch(PDOException $e){
			echo $e->getmessage();
			return false;
		}
	}
	public function __delete($id_league):bool{
		try{
			$query=Connection::getInstance()->connect()->prepare("DELETE FROM league where id_league:id_league");
			$query->bindParam(':id_league',$id_league);
			$query->execute();
			return true;
		}catch(PDOException $e){
			return false;
		}
	}
	public function __loadtable(){
		$query=Connection::getInstance()->connect()->prepare("SELECT c.gamesplayed,lt.id_club,cc.clubname,lt.pts, lt.win,lt.loss, lt.draw, lt.goalsp, lt.goalsc FROM league l  inner join competition c using(id_competition) inner join league_table lt using(id_league) inner join club cc using(id_club) inner join countries ccc on ccc.id_country= cc.id_country where l.id_league=:id_league order by pts desc, win desc, goalsp desc, goalsc asc, loss asc");
	  $query->bindParam(':id_league',$this->id_league);
	  $query->execute();
	  $query->setFetchMode(PDO::FETCH_ASSOC);

		return $query;
	}
	public static function checkIfLeagueAlreadyExists($season,$country,$div,$group){
		try{
			$query=Connection::getInstance()->connect()->prepare("SELECT id_league FROM competition c left join league using(id_competition) where season=:season and id_country=:country and division=:div and divgroup=:group and official=true ");
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
			$query=Connection::getInstance()->connect()->prepare("SELECT division,divgroup from league inner join competition using(id_competition) where id_country=:id_country and official=true order by division desc,divgroup desc limit 1");
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
}
