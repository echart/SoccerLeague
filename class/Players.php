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
	// public function wage();
}
