<?

class PlayerFactory{
	public static $odds=array(1=>15.1,2=>10.1,3=>8.5);
	public static $leg=array('L','R');

	public static function random($min, $max){
	   $decimals = max(strlen(substr(strrchr($min+"", "."), 1)), strlen(substr(strrchr($max+"", "."), 1)));
	   $factor = pow(10, $decimals);
	   return rand($min*$factor, $max*$factor) / $factor;
	}

	public static function createGoalkeper($indice,$id_club){
		$indice=self::$odds[$indice];
		$player = new Goalkeeper(0);
    $player->stamina=PlayerFactory::random($indice,20.0);
    $player->speed =PlayerFactory::random($indice,20.0);
    $player->jump=PlayerFactory::random($indice,20.0);
    $player->resistance=PlayerFactory::random($indice,20.0);
    $player->injury_prop=PlayerFactory::random($indice,20.0);
    $player->professionalism=PlayerFactory::random($indice,20.0);
    $player->agressive=PlayerFactory::random($indice,20.0);
    $player->adaptability=PlayerFactory::random($indice,20.0);
    $player->leadership=PlayerFactory::random($indice,20.0);
    $player->leadership=PlayerFactory::random($indice,20.0);
    $player->workrate=PlayerFactory::random($indice,20.0);
    $player->concentration=PlayerFactory::random($indice,20.0);
    $player->decision=PlayerFactory::random($indice,20.0);
    $player->positioning=PlayerFactory::random($indice,20.0);
    $player->vision=PlayerFactory::random($indice,20.0);
    $player->unpredictability=PlayerFactory::random($indice,20.0);
		$player->communication=PlayerFactory::random($indice,20.0);
		$player->handling=PlayerFactory::random($indice,20.0);
		$player->aerial=PlayerFactory::random($indice,20.0);
		$player->foothability=PlayerFactory::random($indice,20.0);
		$player->oneaone=PlayerFactory::random($indice,20.0);
		$player->reflexes=PlayerFactory::random($indice,20.0);
		$player->rushingout=PlayerFactory::random($indice,20.0);
		$player->kicking=PlayerFactory::random($indice,20.0);
		$player->throwing=PlayerFactory::random($indice,20.0);

		$player->skillIndex();
		$player->position=1;
		$player->id_club=$id_club;
		$query=Connection::getInstance()->connect()->prepare("SELECT abbreviation, id_country FROM club inner join countries using(id_country) where id_club=:id_club");
		$query->bindParam(':id_club',$id_club);
		$query->execute();

		$data=$query->fetch(PDO::FETCH_OBJ);
		$player->id_country=$data->id_country;
		$json = json_decode(file_get_contents('assets/data/playerNames/'.$data->abbreviation.'.json'));
		$player->name= $json->data[0]->names[rand(0,count($json->data[0]->names)-1)]->name. " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname . " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname;
		$player->nickname='';
		$player->age= rand(19,32) . ".0" . rand(1,9);
		$player->height=rand(162,202);
		$player->weight=rand(55,95);
		$player->wage();
		$player->leg=self::$leg[rand(0,1)];

		$player->body=rand(1,10);
		$player->hair=rand(1,10);
		$player->eyes=rand(1,10);
		$player->bear=rand(1,10);

		return $player;
	}
	public static function createPlayer($indice,$id_club){
		$indice=self::$odds[$indice];
		$player = new Lineplayer(0);
    $player->stamina=PlayerFactory::random($indice,20.0);
    $player->speed =PlayerFactory::random($indice,20.0);
    $player->jump=PlayerFactory::random($indice,20.0);
    $player->resistance=PlayerFactory::random($indice,20.0);
    $player->injury_prop=PlayerFactory::random($indice,20.0);
    $player->professionalism=PlayerFactory::random($indice,20.0);
    $player->agressive=PlayerFactory::random($indice,20.0);
    $player->adaptability=PlayerFactory::random($indice,20.0);
    $player->leadership=PlayerFactory::random($indice,20.0);
    $player->leadership=PlayerFactory::random($indice,20.0);
    $player->workrate=PlayerFactory::random($indice,20.0);
    $player->concentration=PlayerFactory::random($indice,20.0);
    $player->decision=PlayerFactory::random($indice,20.0);
    $player->positioning=PlayerFactory::random($indice,20.0);
    $player->vision=PlayerFactory::random($indice,20.0);
    $player->unpredictability=PlayerFactory::random($indice,20.0);
    $player->crossing=PlayerFactory::random($indice,20.0);
    $player->pass=PlayerFactory::random($indice,20.0);
    $player->technical=PlayerFactory::random($indice,20.0);
    $player->ballcontrol=PlayerFactory::random($indice,20.0);
    $player->dribble=PlayerFactory::random($indice,20.0);
    $player->longshot=PlayerFactory::random($indice,20.0);
    $player->finish=PlayerFactory::random($indice,20.0);
    $player->heading=PlayerFactory::random($indice,20.0);
    $player->freekick=PlayerFactory::random($indice,20.0);
    $player->marking=PlayerFactory::random($indice,20.0);
    $player->tackling=PlayerFactory::random($indice,20.0);
		$player->communication=PlayerFactory::random($indice,20.0);
		$player->skillIndex();
		$posI = rand(1,2);
		while($posI--){
			$pos=rand(0,4);
			$side=rand(0,2);

			$sides=array('C','L','R');
			$positions=array('D','DM','M','OM','F');
			$query=Connection::getInstance()->connect()->prepare("SELECT id_position FROM positions where position=:position and side=:side");
			$a = $sides[$side];
			$b = $positions[$pos];
			if($b=='F'){
				$a='C';
			}
			$query->bindParam(':side',$a);
			$query->bindParam(':position',$b);
		  $query->execute();

	    $data=$query->fetch(PDO::FETCH_OBJ);
			$player->position[]=$data->id_position;
		}
		$player->id_club=$id_club;
		$query=Connection::getInstance()->connect()->prepare("SELECT abbreviation, id_country FROM club inner join countries using(id_country) where id_club=:id_club");
		$query->bindParam(':id_club',$id_club);
		$query->execute();

		$data=$query->fetch(PDO::FETCH_OBJ);
		$player->id_country=$data->id_country;
		$json = json_decode(file_get_contents('assets/data/playerNames/'.$data->abbreviation.'.json'));
		$player->name= $json->data[0]->names[rand(0,count($json->data[0]->names)-1)]->name. " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname . " " . $json->data[0]->lastnames[rand(0,count($json->data[0]->lastnames)-1)]->lastname;
		$player->nickname='';
		$player->age=rand(19,32) . ".0" . rand(1,9);
		$player->height=rand(162,202);
		$player->weight=rand(55,95);
		$player->wage();
		$player->leg=self::$leg[rand(0,1)];

		$player->body=rand(1,10);
		$player->hair=rand(1,10);
		$player->eyes=rand(1,10);
		$player->bear=rand(1,10);

		return $player;
	}
	public static function savePlayer(Player $player){
		try{
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players(id_player_club,id_country, name, nickname, age, height, weight, leg)VALUES (:id_player_club,:id_country, :name, :nickname, :age, :height, :weight, :leg)");
			$query->bindParam(":id_player_club",$player->id_club);
			$query->bindParam(":id_country",$player->id_country);
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
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_appearance (id_player,body,eyes,hair,bear) values(:id_player,:body,:eyes,:hair,:bear)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":body",$player->body);
			$query->bindParam(":eyes",$player->eyes);
			$query->bindParam(":hair",$player->hair);
			$query->bindParam(":bear",$player->bear);
			$query->execute();


			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr(id_player, stamina, speed, resistance, injury_propensity, jump, professionalism, agressive, adaptability, leadership, workrate, concentration, decision, positioning, vision, unpredictability, communication) values (:id_player,:stamina,:speed,:resistance,:injury_propensity,:jump,:professionalism,:agressive,:adaptability,:leadership,:workrate,:concentration,:decision,:positioning,:vision,:unpredictability,:communication)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":stamina",$player->stamina);
			$query->bindParam(":speed",$player->speed);
			$query->bindParam(":resistance",$player->resistance);
			$query->bindParam(":injury_propensity",$player->injury_prop);
			$query->bindParam(":jump",$player->jump);
			$query->bindParam(":professionalism",$player->professionalism);
			$query->bindParam(":agressive",$player->agressive);
			$query->bindParam(":adaptability",$player->adaptability);
			$query->bindParam(":leadership",$player->leadership);
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
			foreach ($player->position as $key => $value) {
				$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_position (id_player,id_position) values (:id_player,:id_position)");
				$query->bindParam(":id_player",$id_player);
				$query->bindParam(":id_position",$value);
				$query->execute();

			}
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
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players(id_player_club,id_country, name, nickname, age, height, weight, leg)VALUES (:id_player_club,:id_country, :name, :nickname, :age, :height, :weight, :leg)");
			$query->bindParam(":id_player_club",$player->id_club);
			$query->bindParam(":id_country",$player->id_country);
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
			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_appearance (id_player,body,eyes,hair,bear) values(:id_player,:body,:eyes,:hair,:bear)");
			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":body",$player->body);
			$query->bindParam(":eyes",$player->eyes);
			$query->bindParam(":hair",$player->hair);
			$query->bindParam(":bear",$player->bear);
			$query->execute();

			$query=Connection::getInstance()->connect()->prepare("INSERT INTO players_attr(id_player, stamina, speed, resistance, injury_propensity, jump, professionalism, agressive, adaptability, leadership, workrate, concentration, decision, positioning, vision, unpredictability, communication) values (:id_player,:stamina,:speed,:resistance,:injury_propensity,:jump,:professionalism,:agressive,:adaptability,:leadership,:workrate,:concentration,:decision,:positioning,:vision,:unpredictability,:communication)");

			$query->bindParam(":id_player",$id_player);
			$query->bindParam(":stamina",$player->stamina);
			$query->bindParam(":speed",$player->speed);
			$query->bindParam(":resistance",$player->resistance);
			$query->bindParam(":injury_propensity",$player->injury_prop);
			$query->bindParam(":jump",$player->jump);
			$query->bindParam(":professionalism",$player->professionalism);
			$query->bindParam(":agressive",$player->agressive);
			$query->bindParam(":adaptability",$player->adaptability);
			$query->bindParam(":leadership",$player->leadership);
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
