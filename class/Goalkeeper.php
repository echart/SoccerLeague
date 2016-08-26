<?
class Goalkeeper extends Players{
	public $handling;
	public $aerial;
	public $foothability;
	public $oneaone;
	public $reflexes;
	public $rushingout;
	public $kicking;
	public $throwing;
	public function loadPlayer($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players p inner join players_attr pa using(id_player) inner join players_attr_gk pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	public function loadPlayerInfo($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT name,nickname, age, height, weight, leg FROM players p where id_player=:id_player");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	public function loadPlayerPositions($id_player){
		$positions=array();
		$query=Connection::getInstance()->connect()->prepare("SELECT side,position FROM positions inner join players_position using(id_position) where id_player=:id_player");
		$query->bindParam(':id_player',$id_player);
		$query->execute();
		// while($data = $query->fetch(PDO::FETCH_OBJ)){
		// 	$positions[]['side']=$data->side;
		// 	$positions[]['position']=$data->position;
		// }
		$data=$query->fetch(PDO::FETCH_ASSOC);
		$positions=$data['position'];
		return $positions;
	}
	public function loadPlayerSkills(){
		// TODO: get skills
	}
	//
	public function rec(){
	// TODO: calc rec
	}
	public function skillIndex(){
		$physical=$this->stamina+$this->speed+$this->resistance+$this->jump;
		$psychologic=$this->workrate;$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		$technical=$this->handling+$this->aerial+$this->foothability+$this->oneaone+$this->reflexes+$this->rushingout+$this->kicking+$this->throwing;
		$skill_index=$physical+$technical+$psychologic;
		return $this->skill_index;
	}
	public static function addHistory($id_player,$id_club,$season){
		parent::addHistory($id_player,$id_club,$season);
	}
}
