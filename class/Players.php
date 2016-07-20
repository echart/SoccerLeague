<?
/*
 * @author: echart
 * @description: Player class that will be extended to Goalkeeper or Player;
*/
abstract Players{
	/*info*/
	public $id_player;
	public $id_club;
	public $name;
	public $nickname;
	public $age;
	public $height;
	public $weight;
	public $wage; //
	private $skill_index; // @param $skill_index is an attribute of player that will be calculated by the sum of all the skills(VISIBLES)
	private $rec; // @param: $rec is an attribute of player that will be calculate by the importance of skills for each position that player have.
	/*Physical*/
	public $stamina;
	public $speed;
	public $resistance;
	public $jump;
	private $injury_prop;
	/*Psychologic*/
	private $professionalism;
	private $agressive;
	private $adaptability;
	private $leadership;
	private $learning;
	public $workrate;
	public $concentration;
	public $decision;
	public $positioning;
	public $vision;
	public $unpredictability;
	public $communication;
	/*methods*/
	public function loadPlayer($id_player);
	public function deletePlayer($id_player);

	public function rec();
	public function skillIndex();
	public function wage();
}
