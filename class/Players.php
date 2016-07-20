<?

abstract Players{
	public $id_player;
	public $id_club;
	public $name;
	public $nickname;
	public $age;
	public $height;
	public $weight;
	public $wage;
	private $skill_index;
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

	public function loadPlayer($id_player);
	public function deletePlayer($id_player);

	public function rec();
	public function skillIndex();
	public function wage();
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
	public static function updatePlayer(Player $player,Array $info){
	}
	public static function createGoalkeper();
		return new Goalkeeper();
	}
	public static function createPlayer(){
		return new Player();
	}
}

$player=PlayerFactory::createPlayer();
