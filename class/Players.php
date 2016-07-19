<?

class Players{
	public $id_player;
	public $name;
	public $id_club;
	public $nickname;
	public $age;
	public $height;
	public $weight;
	private $skill_index;
	public $wage;
	private $rec;
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


	function __construct($player=0){
		$this->player_id=$player;
	}

}


class Goalkeeper extends Players{
	public $handling
	public $aeria;
	public $foothability;
	public $oneaone;
	public $reflexes;
	public $rushingout;
	public $kicking;
	public $throwing;
}

class Player extends Players{
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
}

class PlayerFactory{
	public static function updatePlayer();
	public static function createGoalkeper();
	public static function createPlayer();
}
