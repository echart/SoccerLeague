<?
include('Player.php');
include('Goalkeeper.php');

class PlayerFactory{
	public static function updatePlayer(Player $player){

	}
	public static function createGoalkeper(){
		return new Goalkeeper();
	}
	public static function createPlayer(){
		return new Player();
	}
	public static function savePlayer(Player $player);
}
