<?
/*
 * @author: echart
 */
class Player extends Players{
	/*technical*/
	public $crossing;
	public $pass;
	public $technical;
	public $ballcontrol;
	public $dribble;
	public $longshot;
	public $finish;
	public $heading;
	public $freekick;
	public $marking;
	public $tackling;
	public function __construct($id_player){
		parent::__construct($id_player);
	}
	/*methods*/
	public function loadPlayer(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players p inner join players_attr pa using(id_player) inner join players_attr_line pal using(id_player) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		$data=$query->fetch(PDO::FETCH_ASSOC);
		foreach ($data as $key => $value) {
			if($key!='age'){
				if(is_numeric($data[$key])){
					$data[$key]=intval($value);
				}
			}
		}
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
		$query=Connection::getInstance()->connect()->prepare("SELECT side,position FROM positions inner join players_position using(id_position) where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
		// while($data = $query->fetch(PDO::FETCH_OBJ)){
		// 	$positions[]['side']=$data->side;
		// 	$positions[]['position']=$data->position;
		// }
		$data=$query->fetch(PDO::FETCH_OBJ);
		$positions=$data->position . ' ' . $data->side;
		$this->position=$positions;
		return $positions;
	}
	public function loadPlayerSkills(){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_attr pa inner join players_attr_line pal using(id_player) where id_player=:id_player");
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
		$this->marking=$data->marking;
		$this->tackling=$data->tackling;
		$this->crossing=$data->crossing;
		$this->pass=$data->pass;
		$this->technical=$data->technical;
		$this->ballcontrol=$data->ballcontrol;
		$this->dribble=$data->dribble;
		$this->longshot=$data->longshot;
		$this->finish=$data->finish;
		$this->heading=$data->heading;
		$this->freekick=$data->freekick;
	}
	//
	public function rec(){
		$weights=array();
		$position=array();
		$this->loadPlayerSkills();
		$skills=array($this->stamina,$this->speed,$this->resistance,$this->jump,$this->workrate,$this->positioning,$this->concentration,$this->decision,$this->vision,$this->unpredictability,$this->communication,$this->marking,$this->tackling,$this->crossing,$this->pass,$this->technical,$this->ballcontrol,$this->dribble,$this->longshot,$this->finish,$this->heading,$this->freekick);
	# 										  		[sta,spe,res,jum,Emp,Pos,Con,Dec,Vis,Imp,Com,Mar,Des,Cru,Pas,Tec,B.Con,Dri,Lon,Fin,Cab,b.par]
	 	$position['D C']  =	array(	1,	2,	2,	2,	2,	1,	2,	3,  3,  3,  1,  1,  1,  3,  3,   3,  3,   3,  3,  3,  1,  3);
	 	$position['D L']  =	array(	2,	1,	2,	2,	2,	2,	2,	3,  3,  3,  2,  1,  1,  2,  3,   3,  3,   3,  3,  3,  2,  3);
	 	$position['D R']  =	array(	2,	1,	2,	2,	2,	2,	2,	3,  3,  3,  2,  1,  1,  2,  3,   3,  3,   3,  3,  3,  2,  3);
		$position['DM C'] = array(	1,	2,	2,	3,	2,	1,	2,	3,  3,  3,  2,  1,  1,  3,  2,   2,  2,   3,  3,  3,  2,  3);
		$position['DM L'] =	array(	2,	1,	2,	2,	2,	2,	2,	3,  3,  3,  2,  1,  1,  2,  2,   2,  2,   3,  3,  3,  3,  3);
		$position['DM R'] =	array(	2,	1,	2,	2,	2,	2,	2,	3,  3,  3,  2,  1,  1,  2,  2,   2,  2,   3,  3,  3,  3,  3);
	 	$position['M C']  =	array(	2,	2,	2,	3,	2,	2,	2,	1,  1,  2,  2,  2,  2,  2,  1,   1,  1,   2,  2,  2,  3,  3);
		$position['M R']  =	array(	2,	1,	2,	3,	2,	2,	2,	1,  1,  2,  2,  2,  2,  1,  1,   1,  1,   2,  2,  2,  3,  3);
		$position['M L']  =	array(	2,	1,	2,	3,	2,	2,	2,	1,  1,  2,  2,  2,  2,  1,  1,   1,  1,   2,  2,  2,  3,  3);
		$position['OM L'] =	array(	2,	1,	2,	3,	2,	2,	2,	2,  1,  1,  2,  3,  3,  1,  2,   1,  1,   1,  2,  2,  3,  3);
		$position['OM R'] =	array(	2,	1,	2,	3,	2,	2,	2,	2,  1,  1,  2,  3,  3,  1,  2,   1,  1,   1,  2,  2,  3,  3);
		$position['OM C'] =	array(	2,	2,	2,	3,	2,	1,	2,	1,  1,  1,  2,  3,  3,  2,  1,   1,  1,   2,  2,  2,  3,  3);
		$position['F C']  =	array(	1,	2,	2,	2,	1,	1,	2,	2,  2,  1,  3,  3,  3,  3,  2,   2,  1,   2,  2,  1,  1,  3);

		$weights['D C']  =	array(65,33,2);
	 	$weights['D L']  =	array(80,14,6);
	 	$weights['D R']  =	array(80,14,6);
		$weights['DM C'] = 	array(90,10,0);
		$weights['DM L'] =	array(50,40,10);
		$weights['DM R'] =	array(50,40,10);
	 	$weights['M C']  =	array(80,18,2);
		$weights['M R']  =	array(85,13,2);
		$weights['M L']  =	array(85,13,2);
		$weights['OM L'] =	array(60,35,5);
		$weights['OM R'] =	array(60,35,5);
		$weights['OM C'] =	array(90,10,0);
		$weights['F C']  =	array(80,18,2);

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
		$psychologic=$this->workrate+$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		$technical=$this->crossing+$this->pass+$this->technical+$this->ballcontrol+$this->dribble+$this->longshot+$this->finish+$this->heading+$this->freekick+$this->marking+$this->tackling;
		$this->skill_index=$physical+$technical+$psychologic;
		return $this->skill_index;
	}
	public static function addHistory($id_player,$id_club,$season){
		parent::addHistory($id_player,$id_club,$season);
	}
	public static function loadHistory($id_player){
		$query=Connection::getInstance()->connect()->prepare("SELECT * FROM players_history where id_player=:id_player");
		$query->bindParam(':id_player',$id_player);
		$query->execute();

		$query->setFetchMode(PDO::FETCH_OBJ);
		return $query;
	}
	public function deletePlayer(){
		$query=Connection::getInstance()->connect()->prepare("DELETE CASCADE FROM players where id_player=:id_player");
		$query->bindParam(':id_player',$this->id_player);
		$query->execute();
	}
}
