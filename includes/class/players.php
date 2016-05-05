<?

class Players{
	public $player_id;
	public $name;
	public $club_id;
	public $nickname;
	public $age;
	public $height;
	public $weight;
	public $position;
	private $skill_index;
	public $wage;
	private $rec;
	public $strength;
	public $speed;
	public $resistance;

	function Players($player=0){
		$this->player_id=$player;
	}

	function private getWage(){
		return $this->wage;
	}

	function private setWage(){
		$this->wage=0;
		return $this->wage;
	}

	function getPlayer(){

	}
}


class Goalkeeper extends Players{


	function GoalKeeper($player=0){
		$this->id=$player;
	}
}

class LinePlayers extends Players{


	function LinePlayers($player=0){
		$this->id=$player;
	}
}