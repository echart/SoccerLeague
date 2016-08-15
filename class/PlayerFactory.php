<?

class PlayerFactory{
	public static $odds=array(1=>15.1,2=>10.1,3=>8.5);
	public static $leg=array('L','R');
	public static function updatePlayer(Player $player){

	}
	public static function updateGoalkeeper(Goalkeeper $gk){

	}
	public static function createGoalkeper($indice,$id_club){
		$indice=self::$odds[$indice];
		$player = new Goalkeeper();
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

		$player->handling=random($indice,20.0);
		$player->aerial=random($indice,20.0);
		$player->foothability=random($indice,20.0);
		$player->oneaone=random($indice,20.0);
		$player->reflexes=random($indice,20.0);
		$player->rushingout=random($indice,20.0);
		$player->kicking=random($indice,20.0);
		$player->throwing=random($indice,20.0);

		$player->skillIndex();
		$player->position=1;
		$player->id_club=$id_club;
		$json = json_decode(file_get_contents('../assets/data/playerNames/br.json'));
		$player->name= $json->data[0]->names[rand(0,count($json->data[0]->names)-1)]->name. " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname . " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname;
		$player->nickname='';
		$player->age=rand(19,32) . ".0" . rand(1,9);
		$player->height=rand(162,202);
		$player->weight=rand(55,95);
		$player->wage();
		$player->leg=self::$leg[rand(0,1)];

		return $player;
	}
	public static function createPlayer($indice,$id_club){
		$indice=self::$odds[$indice];
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
		$player->communication=random($indice,20.0);
		$player->skillIndex();
		$player->position=rand(2,14);
		$player->id_club=$id_club;
		$json = json_decode(file_get_contents('../assets/data/playerNames/br.json'));
		$player->name= $json->data[0]->names[rand(0,count($json->data[0]->names)-1)]->name. " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname . " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname;
		$player->nickname='';
		$player->age=rand(19,32) . ".0" . rand(1,9);
		$player->height=rand(162,202);
		$player->weight=rand(55,95);
		$player->wage();
		$player->leg=self::$leg[rand(0,1)];

		return $player;
	}
	public static function savePlayer(Player $player){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players(id_player_club, name, nickname, age, height, weight, leg)VALUES (:id_player_club, :name, :nickname, :age, :height, :weight, :leg)");
			$query->bindParam(":id_player_club",$player->id_club);
			$query->bindParam(":name",$player->name);
			$query->bindParam(":nickname",$player->nickname);
			$query->bindParam(":age",$player->age);
			$query->bindParam(":height",$player->height);
			$query->bindParam(":weight",$player->weight);
			$query->bindParam(":leg",$player->leg);

			$query->execute();
			$id_player=Connection::getInstance()->connect()->lastInsertID('players_id_player_seq');
		}catch(PDOException $e){
			echo $e->getmessage();
			exit;
		}
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr(id_player, stamina, speed, resistance, injury_propensity, jump, professionalism, agressive, adptability, learning, workrate, concentration, decision, positioning, vision, unpredictability, communication) values (:id_player,:stamina,:speed,:resistance,:injury_propensity,:jump,:professionalism,:agressive,:adaptability,:learning,:workrate,:concentration,:decision,:positioning,:vision,:unpredictability,:communication)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":stamina",$player->stamina);
			$query->bindParam(":speed",$player->speed);
			$query->bindParam(":resistance",$player->resistance);
			$query->bindParam(":injury_propensity",$player->injury_prop);
			$query->bindParam(":jump",$player->jump);
			$query->bindParam(":professionalism",$player->professionalism);
			$query->bindParam(":agressive",$player->agressive);
			$query->bindParam(":adaptability",$player->adaptability);
			$query->bindParam(":learning",$player->learning);
			$query->bindParam(":workrate",$player->workrate);
			$query->bindParam(":concentration",$player->concentration);
			$query->bindParam(":decision",$player->decision);
			$query->bindParam(":positioning",$player->positioning);
			$query->bindParam(":vision",$player->vision);
			$query->bindParam(":unpredictability",$player->unpredictability);
			$query->bindParam(":communication",$player->communication);

			$query->execute();
		}catch (PDOException $e){
			echo $e->getmessage();exit;
		}
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr_line(id_player, crossing, pass, technical, ballcontrol, dribble, longshot, finish, heading, freekick, marking, tackling) values (:id_player,:crossing,:pass,:technical,:ballcontrol,:dribble,:longshot,:finish,:heading,:freekick,:marking,:tackling)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":crossing",$player->crossing);
			$query->bindParam(":pass",$player->pass);
			$query->bindParam(":technical",$player->technical);
			$query->bindParam(":ballcontrol",$player->ballcontrol);
			$query->bindParam(":dribble",$player->dribble);
			$query->bindParam(":longshot",$player->longshot);
			$query->bindParam(":finish",$player->finish);
			$query->bindParam(":heading",$player->heading);
			$query->bindParam(":freekick",$player->freekick);
			$query->bindParam(":marking",$player->marking);
			$query->bindParam(":tackling",$player->tackling);

			$query->execute();
		}catch(PDOException $e){
			echo $e->getmessage();
		}
		try {
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_position (id_player,id_position) values (:id_player,:id_position)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":id_position",$player->position);
			$query->execute();
		} catch (PDOException $e) {
			echo $e->getmessage();
		}
		$query=Connection::getInstance()->connect()->query("SELECT season FROM season");
	  $query->execute();
    $data=$query->fetch(PDO::FETCH_OBJ);
		Player::addHistory($id_player,$player->id_club,$data->season);

	}
	public static function savedGoalkeeper(Goalkeeper $player){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players(id_player_club, name, nickname, age, height, weight, leg)VALUES (:id_player_club, :name, :nickname, :age, :height, :weight, :leg)");
			$query->bindParam(":id_player_club",$player->id_club);
			$query->bindParam(":name",$player->name);
			$query->bindParam(":nickname",$player->nickname);
			$query->bindParam(":age",$player->age);
			$query->bindParam(":height",$player->height);
			$query->bindParam(":weight",$player->weight);
			$query->bindParam(":leg",$player->leg);

			$query->execute();
			$id_player=Connection::getInstance()->connect()->lastInsertID('players_id_player_seq');
		}catch(PDOException $e){
			echo $e->getmessage();
			exit;
		}
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr(id_player, stamina, speed, resistance, injury_propensity, jump, professionalism, agressive, adptability, learning, workrate, concentration, decision, positioning, vision, unpredictability, communication) values (:id_player,:stamina,:speed,:resistance,:injury_propensity,:jump,:professionalism,:agressive,:adaptability,:learning,:workrate,:concentration,:decision,:positioning,:vision,:unpredictability,:communication)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":stamina",$player->stamina);
			$query->bindParam(":speed",$player->speed);
			$query->bindParam(":resistance",$player->resistance);
			$query->bindParam(":injury_propensity",$player->injury_prop);
			$query->bindParam(":jump",$player->jump);
			$query->bindParam(":professionalism",$player->professionalism);
			$query->bindParam(":agressive",$player->agressive);
			$query->bindParam(":adaptability",$player->adaptability);
			$query->bindParam(":learning",$player->learning);
			$query->bindParam(":workrate",$player->workrate);
			$query->bindParam(":concentration",$player->concentration);
			$query->bindParam(":decision",$player->decision);
			$query->bindParam(":positioning",$player->positioning);
			$query->bindParam(":vision",$player->vision);
			$query->bindParam(":unpredictability",$player->unpredictability);
			$query->bindParam(":communication",$player->communication);

			$query->execute();
		}catch (PDOException $e){
			echo $e->getmessage();exit;
		}

		try {
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr_gk(id_player, handling, aerial, foothability, oneanone, reflexes, rushingout, kicking, throwing) values (:id_player,:handling,:aerial,:foothability,:oneaone,:reflexes,:rushingout,:kicking,:throwing)");
			$query->bindParam(':id_player',$id_player);
			$query->bindParam(':handling',$player->handling);
			$query->bindParam(':aerial',$player->aerial);
			$query->bindParam(':foothability',$player->foothability);
			$query->bindParam(':oneaone',$player->oneaone);
			$query->bindParam(':reflexes',$player->reflexes);
			$query->bindParam(':rushingout',$player->rushingout);
			$query->bindParam(':kicking',$player->kicking);
			$query->bindParam(':throwing',$player->throwing);
			$query->execute();
		} catch (PDOException $e) {
			echo $e->getmessage();
			exit;
		}

		try {
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_position (id_player,id_position) values (:id_player,:id_position)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":id_position",$player->position);
			$query->execute();
		} catch (PDOException $e) {
			echo $e->getmessage();
		}
		$query=Connection::getInstance()->connect()->query("SELECT season FROM season");
	  $query->execute();
    $data=$query->fetch(PDO::FETCH_OBJ);
		Player::addHistory($id_player,$player->id_club,$data->season);
		}
}
