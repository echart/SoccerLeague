<?
class Goalkeeper extends Player{
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
	public function calcwage(){
		parent::calcwage();
	}
	public function __loadskills(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_attr pa inner join players_attr_gk pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		$this->agressive=intval($data->agressive);
		$this->professionalism=intval($data->professionalism);
		$this->injury_prop=intval($data->injury_propensity);
		$this->stamina=intval($data->stamina);
		$this->speed=intval($data->speed);
		$this->resistance=intval($data->resistance);
		$this->jump=intval($data->jump);
		$this->adaptability =intval( $data->adaptability);
		$this->leadership =intval( $data->leadership);
		$this->workrate=intval($data->workrate);
		$this->positioning=intval($data->positioning);
		$this->concentration=intval($data->concentration);
		$this->decision=intval($data->decision);
		$this->vision=intval($data->vision);
		$this->unpredictability=intval($data->unpredictability);
		$this->communication=intval($data->communication);
		$this->handling=intval($data->handling);
		$this->aerial=intval($data->aerial);
		$this->foothability=intval($data->foothability);
		$this->oneanone=intval($data->oneanone);
		$this->reflexes=intval($data->reflexes);
		$this->rushingout=intval($data->rushingout);
		$this->kicking=intval($data->kicking);
		$this->throwing=intval($data->throwing);
	}
	public function __loadskillsDecimals(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_attr pa inner join players_attr_gk pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_OBJ);
		$this->agressive=$data->agressive;
		$this->professionalism=$data->professionalism;
		$this->injury_prop=$data->injury_propensity;
		$this->stamina=$data->stamina;
		$this->speed=$data->speed;
		$this->resistance=$data->resistance;
		$this->jump=$data->jump;
		$this->adaptability = $data->adaptability;
		$this->leadership = $data->leadership;
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
		$this->oneanone=$data->oneanone;
		$this->reflexes=$data->reflexes;
		$this->rushingout=$data->rushingout;
		$this->kicking=$data->kicking;
		$this->throwing=$data->throwing;
	}
	public function __loadpositions(){
		$positions=array();
		$query=Connection::getInstance()->connect()->prepare("SELECT side,position FROM positions inner join players_position using(id_position) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$i=0;
		while($data = $query->fetch(PDO::FETCH_OBJ)){
			$positions[$i]['side']=$data->side;
			$positions[$i]['position']=$data->position;
			$i++;
		}
		$this->position=$positions;
		return $positions;
	}
	//
	public function rec(){
		$skills=array($this->stamina,$this->speed,$this->resistance,$this->jump,$this->workrate,$this->positioning,$this->concentration,$this->decision,$this->vision,$this->unpredictability,$this->communication,$this->handling,$this->aerial,$this->foothability,$this->oneaone,$this->reflexes,$this->rushingout,$this->kicking,$this->throwing);
		$position=array();
		$weights=array();
	# 										  		[sta,spe,res,jum,Emp,Pos,Con,Dec,Vis,Imp,Com,Man,Aer,Foo,1a1,ref,rus,kic,thr]
		$position['GK']  =	array(	2,	3,	3,	1,	2,	2,	2,	2,  3,  3,  2,  1,  2,  3,  1,   1,  1, 3,  3);
		$weights['GK']  =	array(50,42,8);

		$totSkill = 0;
		for ($i=0; $i< sizeof($position['GK']); $i++) {
			if ($skills[$i]>0) {
				$count = 0;
				for ($z=0; $z<sizeof($position['GK']); $z++){
					if ($position['GK'][$z] == $position['GK'][$i]) {
						$count++;
					}
				}
				$totSkill += $skills[$i]*$weights['GK'][$position['GK'][$i]-1] / $count * 10;
			}
		}
		$totSkill = $totSkill / 200;
		$totSkill = (round($totSkill*1000)/1000)/20;

		return number_format($totSkill,1);
	}
	public function physical(){
		$physical=$this->stamina+$this->speed+$this->resistance+$this->jump;
		return $physical;
	}
	public function psychologic(){
		$psychologic=$this->workrate+$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		return $psychologic;
	}
	public function technical(){
		$technical=$this->handling+$this->aerial+$this->foothability+$this->oneaone+$this->reflexes+$this->rushingout+$this->kicking+$this->throwing;
		return $technical;
	}
	public function skillIndex(){
		$physical=$this->stamina+$this->speed+$this->resistance+$this->jump;
		$psychologic=$this->workrate+$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		$technical=$this->handling+$this->aerial+$this->foothability+$this->oneaone+$this->reflexes+$this->rushingout+$this->kicking+$this->throwing;
		$this->skill_index=$this->physical() + $this->technical() + $this->psychologic();
		return $this->skill_index;
	}
	public static function addHistory($id_player,$id_club,$season){
		parent::addHistory($id_player,$id_club,$season);
	}
	public function __delete(){
		$query=Connection::getInstance()->connect()->prepare("DELETE CASCADE FROM players where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
	}
}
