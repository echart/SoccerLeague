<?
include_once('Players.php');
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
	/*methods*/
	// public function loadPlayer($id_player);
	// public function deletePlayer($id_player);
	//
	// public function rec(){
	//
	// }
	public function skillIndex(){
		$physical=$this->stamina+$this->speed+$this->resistance+$this->jump;
		$psychologic=$this->workrate+$this->concentration+$this->decision+$this->positioning+$this->vision+$this->unpredictability+$this->communication;
		$technical=$this->crossing+$this->pass+$this->technical+$this->ballcontrol+$this->dribble+$this->longshot+$this->finish+$this->heading+$this->freekick+$this->marking+$this->tackling;
		$this->skill_index=$physical+$technical+$psychologic;
		return $this->skill_index;
	}
	public function wage(){
		$this->wage=$this->skill_index*2.2;
		return $this->wage;
	}
}
