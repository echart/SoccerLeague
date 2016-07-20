<?
include_once('Player.php');
include_once('Goalkeeper.php');

class PlayerFactory{
	public static function updatePlayer(Player $player){

	}
	public static function updateGoalkeeper(Goalkeeper $gk){

	}
	public static function createGoalkeper(){
		return new Goalkeeper();
	}
	public static function createPlayer($indice){
		$player = new Player();
    $player->stamina=random($indice,20.0);
    $player->speed = random($indice,20.0);
    $player->jump=random($indice,20.0);
    $player->resistance=random($indice,20.0);
    $player->injury_prop=random($indice,20.0);
    $player->professionalism=random($indice,20.0);
    $player->agressive=random($indice,20.0);
    $player->adaptability=random($indice,20.0);
    $player->leadership=random($indice,20.0);
    $player->learning=random($indice,20.0);
    $player->workrate=random($indice,20.0);
    $player->concentration=random($indice,20.0);
    $player->decision=random($indice,20.0);
    $player->positioning=random($indice,20.0);
    $player->vision=random($indice,20.0);
    $player->unpredictability=random($indice,20.0);
    $player->crossing=random($indice,20.0);
    $player->pass=random($indice,20.0);
    $player->technical=random($indice,20.0);
    $player->ballcontrol=random($indice,20.0);
    $player->dribble=random($indice,20.0);
    $player->longshot=random($indice,20.0);
    $player->finish=random($indice,20.0);
    $player->heading=random($indice,20.0);
    $player->freekick=random($indice,20.0);
    $player->marking=random($indice,20.0);
    $player->tackling=random($indice,20.0);
    $player->skillIndex();


		return $player;
	}
	public static function savePlayer(Player $player){
		# TODO: save a player in database
	}
	public static function savedGoalkeeper(Goalkeeper $gk){}
}
