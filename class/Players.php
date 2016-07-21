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
	/*methods*/
	// abstract public function loadPlayer($id_player);
	// abstract public function deletePlayer($id_player);
	//
	// abstract public function rec();
	// abstract public function skillIndex();
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
}
