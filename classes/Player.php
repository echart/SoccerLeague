<?
/*
 * @author: echart
 * @description: Player class that will be extended to Goalkeeper or Lineplayer;
*/
class Player{
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

	public function __loadinfo(){
		$query=Connection::getInstance()->connect()->prepare("SELECT name,nickname, age, height, weight, leg FROM players p where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);

		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);

		$this->name = $data->name;
		$this->nickname = $data->nickname;
		$this->age = $data->age;
		$this->height = $data->height;
		$this->weight = $data->weight;
		$this->wage = $data->leg;
	}

	public static function addHistory($id_player,$id_club,$season){
		  $query=Connection::getInstance()->connect()->prepare("INSERT INTO players_history (id_player,id_club,season) values (:id_player,:id_club,:season)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":id_club",$id_club);
			$query->bindParam(":season",$season);
			$query->execute();
	}

	public static function __this($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_position inner join positions using(id_position) where id_player=:id_player and position='GK'");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		if($query->rowCount()>0){
			return new Goalkeeper($id_player);
		}else{
			return new Lineplayer($id_player);
		}
	}
}
