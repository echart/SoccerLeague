<?
/*
 * @author: echart
 * @description: Player class that will be extended to Goalkeeper or Player;
*/
class Players{
	/*info*/
	public $position;
	public $id_player;
	public $id_club;
	public $name;
	public $nickname;
	public $age;
	public $height;
	public $weight;
	public $wage; //
	public $skill_index; // @param $skill_index is an attribute of player that will be calculated by the sum of all the skills(VISIBLES)
	public $rec; // @param: $rec is an attribute of player that will be calculate by the importance of skills for each position that player have.
	/*Physical*/
	public $stamina;
	public $speed;
	public $resistance;
	public $jump;
	public $injury_prop;
	/*Psychologic*/
	public $professionalism;
	public $agressive;
	public $adaptability;
	public $leadership;
	public $learning;
	public $workrate;
	public $concentration;
	public $decision;
	public $positioning;
	public $vision;
	public $unpredictability;
	public $communication;
	public function __construct($id_player){
		$this->id_player=$id_player;
	}
	/*methods*/
	public function wage(){
		$this->wage=$this->skill_index*2.2;
		return $this->wage;
	}

	public static function addHistory($id_player,$id_club,$season){
		  $query=Connection::getInstance()->connect()->prepare("INSERT INTO players_history (id_player,id_club,season) values (:id_player,:id_club,:season)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":id_club",$id_club);
			$query->bindParam(":season",$season);
			$query->execute();
	}
	public static function updateHistory($id_player,$id_club,$season){

	}

	public static function is($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_position where id_player=:id_player and id_position=1");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		if($query->rowCount()>0){
			return new Goalkeeper();
		}else{
			return new Player();
		}
	}
	public static function getPlayersByIdClub($id_club){
		$arrayPlayers=array();
		$query=Connection::getInstance()->connect()->prepare("SELECT DISTINCT id_player,id_position FROM players INNER JOIN players_position using(id_player) inner join positions using(id_position) WHERE id_player_club=:id_club and id_position!=1 ORDER BY id_position ASC ");
		$query->bindParam(":id_club",$id_club);
		$query->execute();
		while($data=$query->fetch(PDO::FETCH_OBJ)){
			$arrayPlayers[]=$data->id_player;
		}
		return $arrayPlayers;
	}
	public static function getGoalkeepersByIdClub($id_club){
		$arrayPlayers=array();
		$query=Connection::getInstance()->connect()->prepare("SELECT DISTINCT id_player,id_position FROM players INNER JOIN players_position using(id_player) inner join positions using(id_position) WHERE id_player_club=:id_club and id_position=1 ORDER BY id_position ASC");
		$query->bindParam(":id_club",$id_club);
		$query->execute();
		while($data=$query->fetch(PDO::FETCH_OBJ)){
			$arrayPlayers[]=$data->id_player;
		}
		return $arrayPlayers;
	}
}
