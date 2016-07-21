<?php
  require_once('../class/Connection.php');
  require_once('../class/Player.php');
  require_once('../class/Goalkeeper.php');
  require_once('../class/PlayerFactory.php');
  require_once('../helpers/random.php');
  set_time_limit(0); //don't stop the connection! just don't.
  //Goalkeepers
  for ($i=0; $i < 3; $i++) {
    $indice=1;
    $player = PlayerFactory::createGoalkeper($indice,$id_club);
    PlayerFactory::savedGoalkeeper($player);
  }
  // Lineplayers
  for ($i=0; $i <32 ; $i++) {
    $indice=1;
    $player = PlayerFactory::createPlayer($indice,$id_club);
    PlayerFactory::savePlayer($player);
  }
