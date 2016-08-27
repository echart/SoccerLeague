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
	public function __construct($id_player){
		parent::__construct($id_player);
	}
	public function loadPlayer(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players p inner join players_attr pa using(id_player) inner join players_attr_gk pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	public function loadPlayerInfo(){
		$query=Connection::getInstance()->connect()->prepare("SELECT name,nickname, age, height, weight, leg FROM players p where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		return $data;
	}
	public function loadPlayerPositions(){
		$positions=array();
		$query=Connection::getInstance()->connect()->prepare("SELECT side,position FROM positions inner join players_position using(id_position) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		// while($data = $query->fetch(PDO::FETCH_OBJ)){
		// 	$positions[]['side']=$data->side;
		// 	$positions[]['position']=$data->position;
		// }
		$data=$query->fetch(PDO::FETCH_ASSOC);
		$positions=$data['position'];
		$this->position=$positions;
		return $positions;
	}
	public function loadPlayerSkills(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_attr pa inner join players_attr_gk pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		$this->stamina=$data->stamina;
		$this->speed=$data->speed;
		$this->resistance=$data->resistance;
		$this->jump=$data->jump;
		$this->workrate=$data->workrate;
		$this->positioning=$data->positioning;
		$this->concentration=$data->concentration;
		$this->decision=$data->decision;
		$this->vision=$data->vision;
		$this->unpredictability=$data->unpredictability;
		$this->communication=$data->communication;
		$this->handling=$data->handling;
		$this->aerial=$data->aerial;
		$this->foothability=$data->foothability;
		$this->oneaone=$data->oneanone;
		$this->reflexes=$data->reflexes;
		$this->rushingout=$data->rushingout;
		$this->kicking=$data->kicking;
		$this->throwing=$data->throwing;
	}
	//
	public function rec(){
		$this->loadPlayerSkills();
		$skills=array($this->stamina,$this->speed,$this->resistance,$this->jump,$this->workrate,$this->positioning,$this->concentration,$this->decision,$this->vision,$this->unpredictability,$this->communication,$this->handling,$this->aerial,$this->foothability,$this->oneaone,$this->reflexes,$this->rushingout,$this->kicking,$this->throwing);
		$position=array();
		$weights=array();
	# 										  		[sta,spe,res,jum,Emp,Pos,Con,Dec,Vis,Imp,Com,Man,Aer,Foo,1a1,ref,rus,kic,thr]
		$position['GK']  =	array(	2,	3,	3,	1,	2,	2,	2,	2,  3,  3,  2,  1,  2,  3,  1,   1,  1, 3,  3);
		$weights['GK']  =	array(50,42,8);

		$totSkill = 0;
		for ($i=0; $i< sizeof($position[$this->position]); $i++) {
			if ($skills[$i]>0) {
				$count = 0;
				for ($z=0; $z<sizeof($position[$this->position]); $z++){
					if ($position[$this->position][$z] == $position[$this->position][$i]) {
						$count++;
					}
				}
				$totSkill += $skills[$i]*$weights[$this->position][$position[$this->position][$i]-1] / $count * 10;
			}
		}
		$totSkill = $totSkill / 200;
		$totSkill = (round($totSkill*1000)/1000)/20;

		return number_format($totSkill,1);
	}
	public function skillIndex(){
		$physical=$this->stamina+$this->speed+$this->resistance+$this->jump;
		$psychologic=$this->workrate;$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		$technical=$this->handling+$this->aerial+$this->foothability+$this->oneaone+$this->reflexes+$this->rushingout+$this->kicking+$this->throwing;
		$skill_index=$physical+$technical+$psychologic;
		$this->skill_index=$skill_index;
		return $this->skill_index;
	}
	public static function addHistory($id_player,$id_club,$season){
		parent::addHistory($id_player,$id_club,$season);
	}
}
